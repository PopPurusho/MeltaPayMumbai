<?php

namespace Modules\Superadmin\Http\Controllers;

use App\System;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class InstallController extends Controller
{
    public function __construct()
    {
        $this->module_name = 'superadmin';
        $this->app_version = config('superadmin.module_version');
    }

    public function index()
    {
        if (!auth()->user()->can('manage_modules')) {
            abort(403, 'Unauthorized action.');
        }

        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '512M');

        $this->installSettings();
        
        $output = ['success' => 1,
            'msg' => 'Superadmin module installed successfully'
        ];

        return redirect()->action([\App\Http\Controllers\Install\ModulesController::class, 'index'])->with('status', $output);
    }

    private function installSettings()
    {
        config(['superadmin.module_version' => '1.0']);
        $version = config('superadmin.module_version');

        System::addProperty($this->module_name . '_version', $version);
      
        Artisan::call('module:migrate', ['module' => 'Superadmin', '--force' => true]);
    }
    
    public function uninstall()
    {
         if (!auth()->user()->can('manage_modules')) {
            abort(403, 'Unauthorized action.');
        }
        
        System::removeProperty($this->module_name . '_version');
        
        // Artisan::call('module:migrate-rollback', ['module' => 'Superadmin']);

        $output = ['success' => 1,
            'msg' => 'Superadmin module uninstalled successfully'
        ];

        return redirect()->back()->with('status', $output);
    }

    public function update()
    {
         // Logic for update if needed
    }
}
