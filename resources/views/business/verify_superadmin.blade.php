@extends('layouts.auth2')
@section('title', 'SuperAdmin Verification Required')

@section('content')
    <div class="auth-split">
        {{-- Image Side --}}
        <div class="auth-split-image">
            <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=960&q=80" alt="Business Dashboard">
            <div class="image-overlay">
                <h2>Admin Access</h2>
                <p>Verify your SuperAdmin credentials to manage business registrations and system settings.</p>
            </div>
        </div>

        {{-- Form Side --}}
        <div class="auth-split-form">
            {{-- Header --}}
            <div style="margin-bottom:28px;">
                <div style="width:48px; height:48px; border-radius:14px; background:linear-gradient(135deg, rgba(251,191,36,0.12), rgba(245,158,11,0.12)); display:inline-flex; align-items:center; justify-content:center; margin-bottom:14px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3" />
                        <path d="M12 11m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                        <path d="M12 12l0 2.5" />
                    </svg>
                </div>
                <h1 class="auth-title">SuperAdmin Verification</h1>
                <p class="auth-subtitle">Enter SuperAdmin credentials to proceed with registration</p>
            </div>

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible" style="margin-bottom:18px;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success alert-dismissible" style="margin-bottom:18px;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ session('success') }}
                </div>
            @endif

            {!! Form::open(['url' => route('business.postVerifySuperAdmin'), 'method' => 'post', 'id' => 'superadmin_verify_form']) !!}

            {{-- Username --}}
            <div style="margin-bottom:18px;">
                <label class="auth-label">SuperAdmin Username <span class="text-danger">*</span></label>
                <div class="auth-input-icon">
                    <span class="input-icon-left"><i class="fas fa-user-shield"></i></span>
                    {!! Form::text('superadmin_username', null, [
                        'class' => 'auth-input',
                        'style' => 'padding-left:42px;',
                        'placeholder' => 'Enter SuperAdmin Username',
                        'required',
                        'autofocus'
                    ]) !!}
                </div>
                @if($errors->has('superadmin_username'))
                    <span class="help-block"><strong>{{ $errors->first('superadmin_username') }}</strong></span>
                @endif
            </div>

            {{-- Password --}}
            <div style="margin-bottom:24px;">
                <label class="auth-label">SuperAdmin Password <span class="text-danger">*</span></label>
                <div class="auth-input-icon">
                    <span class="input-icon-left"><i class="fas fa-lock"></i></span>
                    {!! Form::password('superadmin_password', [
                        'class' => 'auth-input',
                        'style' => 'padding-left:42px;',
                        'placeholder' => 'Enter SuperAdmin Password',
                        'required'
                    ]) !!}
                </div>
                @if($errors->has('superadmin_password'))
                    <span class="help-block"><strong>{{ $errors->first('superadmin_password') }}</strong></span>
                @endif
            </div>

            <button type="submit" class="auth-btn-primary">
                <i class="fa fa-check" style="margin-right:6px;"></i> Verify & Proceed to Registration
            </button>

            <div style="text-align:center; margin-top:18px;">
                <p style="font-size:12px; color:#94a3b8; margin:0;">
                    <i class="fa fa-info-circle" style="margin-right:4px;"></i>
                    Verification is valid for 30 minutes
                </p>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#superadmin_verify_form').submit(function(e) {
                var submitBtn = $(this).find('button[type="submit"]');
                var originalText = submitBtn.html();
                submitBtn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Verifying...');
                setTimeout(function() {
                    submitBtn.prop('disabled', false).html(originalText);
                }, 3000);
            });
        });
    </script>
@endsection

