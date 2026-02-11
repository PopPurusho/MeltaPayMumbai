@extends('layouts.auth2')
@section('title', __('lang_v1.login'))
@inject('request', 'Illuminate\Http\Request')
@section('content')
    @php
        $username = old('username');
        $password = null;
        if (config('app.env') == 'demo') {
            $username = 'admin';
            $password = '123456';

            $demo_types = [
                'all_in_one' => 'admin',
                'super_market' => 'admin',
                'pharmacy' => 'admin-pharmacy',
                'electronics' => 'admin-electronics',
                'services' => 'admin-services',
                'restaurant' => 'admin-restaurant',
                'superadmin' => 'superadmin',
                'woocommerce' => 'woocommerce_user',
                'essentials' => 'admin-essentials',
                'manufacturing' => 'manufacturer-demo',
            ];

            if (!empty($_GET['demo_type']) && array_key_exists($_GET['demo_type'], $demo_types)) {
                $username = $demo_types[$_GET['demo_type']];
            }
        }
    @endphp

    {{-- Demo Shops Panel (shown above when in demo mode) --}}
    @if (config('app.env') == 'demo')
    <div style="max-width:1060px; margin:0 auto 24px;">
        <div class="auth-card" style="padding:28px 24px;">
            <h3 style="font-size:18px; font-weight:700; color:#0f172a; margin:0 0 4px;">Demo Shops</h3>
            <p style="font-size:13px; color:#64748b; margin:0 0 18px;">Demos are for example purposes only. <strong>Click to login.</strong></p>
            <div style="display:flex; flex-wrap:wrap; gap:8px;">
                <a href="?demo_type=all_in_one" class="auth-btn-outline demo-login" data-admin="{{ $demo_types['all_in_one'] }}"><i class="fas fa-star" style="margin-right:6px; color:#6366f1;"></i> All In One</a>
                <a href="?demo_type=pharmacy" class="auth-btn-outline demo-login" data-admin="{{ $demo_types['pharmacy'] }}"><i class="fas fa-medkit" style="margin-right:6px; color:#ef4444;"></i> Pharmacy</a>
                <a href="?demo_type=services" class="auth-btn-outline demo-login" data-admin="{{ $demo_types['services'] }}"><i class="fas fa-wrench" style="margin-right:6px; color:#f97316;"></i> Multi-Service</a>
                <a href="?demo_type=electronics" class="auth-btn-outline demo-login" data-admin="{{ $demo_types['electronics'] }}"><i class="fas fa-laptop" style="margin-right:6px; color:#8b5cf6;"></i> Electronics</a>
                <a href="?demo_type=super_market" class="auth-btn-outline demo-login" data-admin="{{ $demo_types['super_market'] }}"><i class="fas fa-shopping-cart" style="margin-right:6px; color:#3b82f6;"></i> Super Market</a>
                <a href="?demo_type=restaurant" class="auth-btn-outline demo-login" data-admin="{{ $demo_types['restaurant'] }}"><i class="fas fa-utensils" style="margin-right:6px; color:#f43f5e;"></i> Restaurant</a>
            </div>
            <div class="auth-divider"></div>
            <p style="font-size:12px; color:#94a3b8; margin:0 0 10px;"><i class="fas fa-plug" style="margin-right:4px;"></i> Premium Modules</p>
            <div style="display:flex; flex-wrap:wrap; gap:8px;">
                <a href="?demo_type=superadmin" class="auth-btn-outline demo-login" data-admin="{{ $demo_types['superadmin'] }}"><i class="fas fa-university" style="margin-right:6px; color:#6366f1;"></i> SaaS</a>
                <a href="?demo_type=woocommerce" class="auth-btn-outline demo-login" data-admin="{{ $demo_types['woocommerce'] }}"><i class="fab fa-wordpress" style="margin-right:6px; color:#8b5cf6;"></i> WooCommerce</a>
                <a href="?demo_type=essentials" class="auth-btn-outline demo-login" data-admin="{{ $demo_types['essentials'] }}"><i class="fas fa-check-circle" style="margin-right:6px; color:#10b981;"></i> Essentials & HRM</a>
                <a href="?demo_type=manufacturing" class="auth-btn-outline demo-login" data-admin="{{ $demo_types['manufacturing'] }}"><i class="fas fa-industry" style="margin-right:6px; color:#f59e0b;"></i> Manufacturing</a>
                <a href="?demo_type=superadmin" class="auth-btn-outline demo-login" data-admin="{{ $demo_types['superadmin'] }}"><i class="fas fa-project-diagram" style="margin-right:6px; color:#ec4899;"></i> Project</a>
                <a href="?demo_type=services" class="auth-btn-outline demo-login" data-admin="{{ $demo_types['services'] }}"><i class="fas fa-wrench" style="margin-right:6px; color:#f97316;"></i> Repair</a>
                <a href="{{ url('docs') }}" target="_blank" class="auth-btn-outline"><i class="fas fa-network-wired" style="margin-right:6px; color:#10b981;"></i> API Docs</a>
            </div>
        </div>
    </div>
    @endif

    {{-- Side-by-Side Login --}}
    <div class="auth-split">
        {{-- Image Side --}}
        <div class="auth-split-image">
            <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=960&q=80" alt="POS System">
            <div class="image-overlay">
                <h2>Simplify Your Business</h2>
                <p>Powerful point-of-sale system to manage sales, inventory, and customers — all in one place.</p>
            </div>
        </div>

        {{-- Form Side --}}
        <div class="auth-split-form">
            {{-- Header --}}
            <div style="margin-bottom:28px;">
                <div style="width:48px; height:48px; border-radius:14px; background:linear-gradient(135deg, rgba(99,102,241,0.12), rgba(139,92,246,0.12)); display:inline-flex; align-items:center; justify-content:center; margin-bottom:14px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                </div>
                <h1 class="auth-title">@lang('lang_v1.welcome_back')</h1>
                <p class="auth-subtitle">@lang('lang_v1.login_to_your') {{ config('app.name', 'ultimatePOS') }}</p>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('login') }}" id="login-form">
                {{ csrf_field() }}

                {{-- Username --}}
                <div style="margin-bottom:18px;" class="{{ $errors->has('username') ? 'has-error' : '' }}">
                    <label class="auth-label">@lang('lang_v1.username')</label>
                    <div class="auth-input-icon">
                        <span class="input-icon-left"><i class="fas fa-user"></i></span>
                        <input class="auth-input" name="username" id="username" type="text"
                            value="{{ $username }}" required autofocus placeholder="@lang('lang_v1.username')" />
                    </div>
                    @if ($errors->has('username'))
                        <span class="help-block"><strong>{{ $errors->first('username') }}</strong></span>
                    @endif
                </div>

                {{-- Password --}}
                <div style="margin-bottom:18px; position:relative;" class="{{ $errors->has('password') ? 'has-error' : '' }}">
                    <div style="display:flex; justify-content:space-between; align-items:center;">
                        <label class="auth-label" style="margin-bottom:0;">@lang('lang_v1.password')</label>
                        @if (config('app.env') != 'demo')
                            <a href="{{ route('password.request') }}" class="auth-link" style="font-size:12px;" tabindex="-1">@lang('lang_v1.forgot_your_password')</a>
                        @endif
                    </div>
                    <div class="auth-input-icon" style="margin-top:6px; position:relative;">
                        <span class="input-icon-left"><i class="fas fa-lock"></i></span>
                        <input class="auth-input" id="password" type="password" name="password"
                            value="{{ $password }}" required placeholder="@lang('lang_v1.password')" style="padding-right:44px;" />
                        <button type="button" id="show_hide_icon" style="position:absolute; right:12px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; padding:0; color:#94a3b8;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                            </svg>
                        </button>
                    </div>
                    @if ($errors->has('password'))
                        <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                    @endif
                </div>

                {{-- Remember Me --}}
                <div style="margin-bottom:20px;">
                    <label class="auth-checkbox">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span>@lang('lang_v1.remember_me')</span>
                    </label>
                </div>

                {{-- Recaptcha --}}
                @if(config('constants.enable_recaptcha'))
                <div style="margin-bottom:18px;">
                    <div class="g-recaptcha" data-sitekey="{{ config('constants.google_recaptcha_key') }}"></div>
                    @if ($errors->has('g-recaptcha-response'))
                        <span class="help-block">{{ $errors->first('g-recaptcha-response') }}</span>
                    @endif
                </div>
                @endif

                {{-- Submit --}}
                <button type="submit" class="auth-btn-primary" style="margin-top:4px;">
                    @lang('lang_v1.login')
                </button>
            </form>

            {{-- Register Link --}}
            @if (!($request->segment(1) == 'business' && $request->segment(2) == 'register'))
                @if (config('constants.allow_registration'))
                    <div style="text-align:center; margin-top:20px;">
                        <span style="font-size:13px; color:#94a3b8;">{{ __('business.not_yet_registered') }}</span>
                        <a href="{{ route('business.getRegister') }}@if (!empty(request()->lang)){{ '?lang=' . request()->lang }}@endif"
                            class="auth-link" style="font-size:13px; margin-left:4px;">{{ __('business.register_now') }}</a>
                    </div>
                @endif
            @endif
        </div>
    </div>

@stop
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#show_hide_icon').off('click');
            $('.change_lang').click(function() {
                window.location = "{{ route('login') }}?lang=" + $(this).attr('value');
            });
            $('a.demo-login').click(function(e) {
                e.preventDefault();
                $('#username').val($(this).data('admin'));
                $('#password').val("{{ $password }}");
                $('form#login-form').submit();
            });

            $('#show_hide_icon').on('click', function(e) {
                e.preventDefault();
                const passwordInput = $('#password');
                if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                    $('#show_hide_icon').html('<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.585 10.587a2 2 0 0 0 2.829 2.828"/><path d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87"/><path d="M3 3l18 18"/></svg>');
                } else {
                    passwordInput.attr('type', 'password');
                    $('#show_hide_icon').html('<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"/><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"/></svg>');
                }
            });
        })
    </script>
@endsection
