<?php

namespace Modules\Superadmin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;

class SuperadminController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        return redirect()->action([\Modules\Superadmin\Http\Controllers\BusinessController::class, 'index']);
    }
}
