@extends('layouts.auth2')

@section('title', __('lang_v1.reset_password'))

@section('content')

    <div class="auth-split">
        {{-- Image Side --}}
        <div class="auth-split-image">
            <img src="https://images.unsplash.com/photo-1553877522-43269d4ea984?w=960&q=80" alt="Business Security">
            <div class="image-overlay">
                <h2>Account Recovery</h2>
                <p>We'll send you a secure link to reset your password and get back to managing your business.</p>
            </div>
        </div>

        {{-- Form Side --}}
        <div class="auth-split-form">
            {{-- Header --}}
            <div style="margin-bottom:28px;">
                <div style="width:48px; height:48px; border-radius:14px; background:linear-gradient(135deg, rgba(251,191,36,0.12), rgba(251,146,60,0.12)); display:inline-flex; align-items:center; justify-content:center; margin-bottom:14px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
                        <line x1="12" y1="17" x2="12.01" y2="17"/>
                    </svg>
                </div>
                <h1 class="auth-title" style="font-size:22px;">@lang('lang_v1.send_password_reset_link')</h1>
                <p class="auth-subtitle">Enter your email to receive a reset link</p>
            </div>

            @if (session('status') && is_string(session('status')))
                <div class="alert alert-info" role="alert" style="margin-bottom:18px;">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}
                <div style="margin-bottom:20px;" class="{{ $errors->has('email') ? 'has-error' : '' }}">
                    <label class="auth-label">@lang('Email')</label>
                    <div class="auth-input-icon">
                        <span class="input-icon-left"><i class="fas fa-envelope"></i></span>
                        <input id="email" type="email" class="auth-input" style="padding-left:42px;"
                            name="email" value="{{ old('email') }}" required autofocus
                            placeholder="@lang('lang_v1.email_address')">
                    </div>
                    @if ($errors->has('email'))
                        <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                    @endif
                </div>

                <button type="submit" class="auth-btn-primary">
                    @lang('lang_v1.send_password_reset_link')
                </button>
            </form>
        </div>
    </div>
@endsection
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.change_lang').click(function() {
                window.location = "{{ route('password.request') }}?lang=" + $(this).attr('value');
            });
        })
    </script>
@endsection