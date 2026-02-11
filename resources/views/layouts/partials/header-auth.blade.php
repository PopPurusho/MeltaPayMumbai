@inject('request', 'Illuminate\Http\Request')

<nav class="auth-topbar-modern">
    <div style="display:flex; align-items:center; gap:16px;">
        <a href="{{ url('/') }}" style="display:flex; align-items:center; gap:10px; text-decoration:none;">
            <img src="https://i.ibb.co/Z11W3GNt/logo-small.jpg" alt="Logo" class="topbar-logo" />
            <span style="font-size:18px; font-weight:700; color:#0f172a; letter-spacing:-0.02em;">MeltaPay</span>
        </a>
        @if(config('constants.SHOW_REPAIR_STATUS_LOGIN_SCREEN') && Route::has('repair-status'))
            <a href="{{ action([\Modules\Repair\Http\Controllers\CustomerRepairStatusController::class, 'index']) }}">
                @lang('repair::lang.repair_status')
            </a>
        @endif
        @if(Route::has('member_scanner'))
            <a href="{{ action([\Modules\Gym\Http\Controllers\MemberController::class, 'member_scanner']) }}">
                @lang('gym::lang.gym_member_profile')
            </a>
        @endif
    </div>
    <div class="topbar-nav">
        @if (!($request->segment(1) == 'business' && $request->segment(2) == 'register') && $request->segment(1) != 'login')
            <a href="{{ action([\App\Http\Controllers\Auth\LoginController::class, 'login']) }}@if (!empty(request()->lang)){{ '?lang=' . request()->lang }}@endif">{{ __('business.sign_in') }}</a>
        @endif
        @if (!($request->segment(1) == 'business' && $request->segment(2) == 'register'))
            @if (config('constants.allow_registration'))
                <a href="{{ route('business.getRegister') }}@if(!empty(request()->lang)){{'?lang='.request()->lang}}@endif"
                    class="auth-btn-outline">{{ __('business.register') }}</a>
                @if (Route::has('pricing') && config('app.env') != 'demo' && $request->segment(1) != 'pricing')
                    <a href="{{ action([\Modules\Superadmin\Http\Controllers\PricingController::class, 'index']) }}">@lang('superadmin::lang.pricing')</a>
                @endif
            @endif
        @endif
        @include('layouts.partials.language_btn')
    </div>
</nav>
