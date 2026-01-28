<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifySuperAdminForRegistration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if SuperAdmin verification exists in session and is still valid
        if (!session()->has('superadmin_verified_for_registration')) {
            return redirect()->route('business.verifySuperAdmin');
        }

        // Check if verification has expired (30 minutes)
        $verificationTime = session('superadmin_verified_at');
        if (!$verificationTime || now()->diffInMinutes($verificationTime) > 30) {
            session()->forget(['superadmin_verified_for_registration', 'superadmin_verified_at']);
            return redirect()->route('business.verifySuperAdmin')
                ->with('error', 'SuperAdmin verification has expired. Please verify again.');
        }

        return $next($request);
    }
}
