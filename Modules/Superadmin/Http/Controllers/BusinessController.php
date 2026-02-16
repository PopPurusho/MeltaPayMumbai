<?php

namespace Modules\Superadmin\Http\Controllers;

use App\Business;
use App\User;
use App\Utils\BusinessUtil;
use App\Utils\ModuleUtil;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class BusinessController extends Controller
{
    protected $businessUtil;
    protected $moduleUtil;

    /**
     * Constructor
     *
     * @param  BusinessUtil  $businessUtil
     * @param  ModuleUtil  $moduleUtil
     * @return void
     */
    public function __construct(BusinessUtil $businessUtil, ModuleUtil $moduleUtil)
    {
        $this->businessUtil = $businessUtil;
        $this->moduleUtil = $moduleUtil;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('superadmin') && !auth()->user()->is_superadmin) {
             // Fallback check if permission/role check fails, though middleware should catch this.
        }

        if (request()->ajax()) {
            $businesses = Business::with('owner')->select(['id', 'name', 'owner_id', 'created_at', 'is_active']);

            return Datatables::of($businesses)
                ->addColumn('owner_name', function ($business) {
                    return $business->owner ? $business->owner->user_full_name : '';
                })
                ->addColumn('action', function ($business) {
                    $current_business_id = request()->session()->get('user.business_id');
                    if ($business->id == $current_business_id) {
                        return '';
                    }

                    $action = '<div class="tw-flex tw-flex-wrap tw-gap-2">';
                    
                    // Manage button
                    $action .= '<a href="' . route('superadmin.business.show', $business->id) . '" class="btn btn-info btn-xs cursor-pointer"><i class="fa fa-cog"></i> Manage</a>';
                    
                    // Activate/Deactivate button
                    if ($business->is_active) {
                         $action .= '<a href="' . route('superadmin.business.toggle-active', $business->id) . '" class="btn btn-danger btn-xs cursor-pointer"><i class="fa fa-power-off"></i> Deactivate</a>';
                    } else {
                        $action .= '<a href="' . route('superadmin.business.toggle-active', $business->id) . '" class="btn btn-success btn-xs cursor-pointer"><i class="fa fa-play"></i> Activate</a>';
                    }

                    // Delete button
                    $action .= '<button data-href="' . route('superadmin.business.destroy', $business->id) . '" class="btn btn-danger btn-xs delete-business"><i class="fa fa-trash"></i> Delete</button>';

                    $action .= '</div>';

                    return $action;
                })
                ->editColumn('created_at', function ($business) {
                    return $business->created_at->format('Y-m-d H:i');
                })
                ->editColumn('is_active', function ($business) {
                    return $business->is_active 
                        ? '<span class="label label-success">Active</span>' 
                        : '<span class="label label-danger">Inactive</span>';
                })
                ->rawColumns(['action', 'is_active'])
                ->make(true);
        }

        return view('superadmin::business.index');
    }

    /**
     * Show the business details and related users.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $business = Business::findOrFail($id);
        $users = User::where('business_id', $id)->with('roles')->get();

        return view('superadmin::business.show', compact('business', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currencies = $this->businessUtil->allCurrencies();
        $timezone_list = $this->businessUtil->allTimeZones();
        $accounting_methods = $this->businessUtil->allAccountingMethods();

        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[$i] = __('business.months.'.$i);
        }

        return view('superadmin::business.create', compact('currencies', 'timezone_list', 'accounting_methods', 'months'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = $request->validate(
                [
                    'name' => 'required|max:255',
                    'currency_id' => 'required|numeric',
                    'country' => 'required|max:255',
                    'state' => 'required|max:255',
                    'city' => 'required|max:255',
                    'zip_code' => 'required|max:255',
                    'landmark' => 'required|max:255',
                    'time_zone' => 'required|max:255',
                    'surname' => 'max:10',
                    'email' => 'sometimes|nullable|email|unique:users|max:255',
                    'first_name' => 'required|max:255',
                    'username' => 'required|min:4|max:255|unique:users',
                    'password' => 'required|min:4|max:255',
                    'fy_start_month' => 'required',
                    'accounting_method' => 'required',
                ]
            );

            DB::beginTransaction();

            //Create owner.
            $owner_details = $request->only(['surname', 'first_name', 'last_name', 'username', 'email', 'password', 'language']);

            $owner_details['language'] = empty($owner_details['language']) ? config('app.locale') : $owner_details['language'];

            $user = User::create_user($owner_details);

            $business_details = $request->only(['name', 'start_date', 'currency_id', 'time_zone',
                'fy_start_month', 'accounting_method', 'tax_label_1', 'tax_number_1',
                'tax_label_2', 'tax_number_2', ]);

            $business_location = $request->only(['name', 'country', 'state', 'city', 'zip_code', 'landmark',
                'website', 'mobile', 'alternate_number', ]);

            //Create the business
            $business_details['owner_id'] = $user->id;
            if (! empty($business_details['start_date'])) {
                $business_details['start_date'] = Carbon::createFromFormat(config('constants.default_date_format'), $business_details['start_date'])->toDateString();
            }

            //upload logo
            $logo_name = $this->businessUtil->uploadFile($request, 'business_logo', 'business_logos', 'image');
            if (! empty($logo_name)) {
                $business_details['logo'] = $logo_name;
            }

            //default enabled modules
            $business_details['enabled_modules'] = ['purchases', 'add_sale', 'pos_sale', 'stock_transfers', 'stock_adjustment', 'expenses'];

            $business = $this->businessUtil->createNewBusiness($business_details);

            //Update user with business id
            $user->business_id = $business->id;
            $user->save();

            $this->businessUtil->newBusinessDefaultResources($business->id, $user->id);
            $new_location = $this->businessUtil->addLocation($business->id, $business_location);

            //create new permission with the new location (if not exists)
            Permission::firstOrCreate(['name' => 'location.'.$new_location->id, 'guard_name' => 'web']);

            DB::commit();

            $output = ['success' => 1,
                        'msg' => __('business.business_created_succesfully')
                    ];

            return redirect()->action([\Modules\Superadmin\Http\Controllers\BusinessController::class, 'index'])->with('status', $output);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());

            $output = ['success' => 0,
                            'msg' => __('messages.something_went_wrong')
                        ];
            return back()->with('status', $output)->withInput();
        }
    }



    /**
     * Toggle active status
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function toggleActive($id)
    {
        $business = Business::findOrFail($id);
        $business->is_active = !$business->is_active;
        $business->save();

        $msg = $business->is_active ? 'Business activated successfully' : 'Business deactivated successfully';
        return redirect()->back()->with('status', ['success' => 1, 'msg' => $msg]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!auth()->user()->can('superadmin') && !auth()->user()->is_superadmin) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            try {
                $business = Business::findOrFail($id);
                
                // Optional: check if business can be deleted (e.g. not deleting the current business)
                $current_business_id = request()->session()->get('user.business_id');
                if ($business->id == $current_business_id) {
                    return [
                        'success' => false,
                        'msg' => 'Cannot delete the current active business'
                    ];
                }

                $business->delete();

                $output = [
                    'success' => true,
                    'msg' => 'Business deleted successfully'
                ];
            } catch (\Exception $e) {
                \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
                $output = [
                    'success' => false,
                    'msg' => 'Something went wrong while deleting business'
                ];
            }

            return $output;
        }
    }
}
