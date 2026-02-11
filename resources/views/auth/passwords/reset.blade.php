@extends('layouts.auth2')

@section('title', __('lang_v1.reset_password'))

@section('content')
    <div class="auth-split">
        {{-- Image Side --}}
        <div class="auth-split-image">
            <img src="https://images.unsplash.com/photo-1556742111-a301076d9d18?w=960&q=80" alt="Inventory Management">
            <div class="image-overlay">
                <h2>Secure Your Account</h2>
                <p>Set a strong new password to keep your business data safe and secure.</p>
            </div>
        </div>

        {{-- Form Side --}}
        <div class="auth-split-form">
            {{-- Header --}}
            <div style="margin-bottom:28px;">
                <div style="width:48px; height:48px; border-radius:14px; background:linear-gradient(135deg, rgba(99,102,241,0.12), rgba(139,92,246,0.12)); display:inline-flex; align-items:center; justify-content:center; margin-bottom:14px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"/>
                    </svg>
                </div>
                <h1 class="auth-title" style="font-size:22px;">@lang('lang_v1.reset_password')</h1>
                <p class="auth-subtitle">Create a new password for your account</p>
            </div>

            <form method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}
                <input type="hidden" name="token" value="{{ $token }}">

                {{-- Email --}}
                <div style="margin-bottom:18px;" class="{{ $errors->has('email') ? 'has-error' : '' }}">
                    <label class="auth-label">@lang('Email')</label>
                    <div class="auth-input-icon">
                        <span class="input-icon-left"><i class="fas fa-envelope"></i></span>
                        <input id="email" type="email" class="auth-input" style="padding-left:42px;"
                            name="email" value="{{ $email ?? old('email') }}" required autofocus
                            placeholder="@lang('lang_v1.email_address')">
                    </div>
                    @if ($errors->has('email'))
                        <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                    @endif
                </div>

                {{-- Password --}}
                <div style="margin-bottom:18px;" class="{{ $errors->has('password') ? 'has-error' : '' }}">
                    <label class="auth-label">@lang('lang_v1.password')</label>
                    <div class="auth-input-icon">
                        <span class="input-icon-left"><i class="fas fa-lock"></i></span>
                        <input id="password" type="password" class="auth-input" style="padding-left:42px;"
                            name="password" required placeholder="@lang('lang_v1.password')">
                    </div>
                    @if ($errors->has('password'))
                        <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                    @endif
                </div>

                {{-- Confirm Password --}}
                <div style="margin-bottom:22px;" class="{{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <label class="auth-label">@lang('business.confirm_password')</label>
                    <div class="auth-input-icon">
                        <span class="input-icon-left"><i class="fas fa-lock"></i></span>
                        <input id="password-confirm" type="password" class="auth-input" style="padding-left:42px;"
                            name="password_confirmation" required placeholder="@lang('business.confirm_password')">
                    </div>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
                    @endif
                </div>

                <button type="submit" class="auth-btn-primary">
                    @lang('lang_v1.reset_password')
                </button>
            </form>
        </div>
    </div>
@endsection
