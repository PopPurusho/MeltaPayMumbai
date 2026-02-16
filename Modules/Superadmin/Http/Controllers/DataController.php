<?php

namespace Modules\Superadmin\Http\Controllers;

use Illuminate\Routing\Controller;
use Menu;
use App\Utils\ModuleUtil;

class DataController extends Controller
{
    public function modifyAdminMenu()
    {
        $menu = Menu::instance('admin-sidebar-menu');
        
        $administrator_list = config('constants.administrator_usernames');
        $is_superadmin = false;

        if (! empty(auth()->user()) && in_array(strtolower(auth()->user()->username), explode(',', strtolower($administrator_list)))) {
             $is_superadmin = true;
        }

        if ($is_superadmin) {
            $menu->url(
                action([\Modules\Superadmin\Http\Controllers\BusinessController::class, 'index']),
                'Superadmin',
                ['icon' => '<svg aria-hidden="true" class="tw-size-5 tw-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 3l8 4.5v9l-8 4.5l-8 -4.5v-9l8 -4.5"></path>
                <path d="M12 12l8 -4.5"></path>
                <path d="M8.2 9.8l7.6 -4.6"></path>
                <path d="M12 12v9"></path>
                <path d="M12 12l-8 -4.5"></path>
              </svg>', 'active' => request()->segment(1) == 'superadmin']
            )->order(1);
        }
    }
}
