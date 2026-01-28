@extends('layouts.auth2')
@section('title', 'SuperAdmin Verification Required')

@section('content')
    <div class="col-md-6 col-xs-12 col-md-offset-3 tw-mt-6">
        <div class="tw-p-2 sm:tw-p-3 tw-mb-4 tw-transition-all tw-duration-200 tw-bg-white tw-shadow-sm tw-rounded-xl tw-ring-1 tw-ring-gray-200">
            <div class="tw-flex tw-flex-col tw-gap-4 tw-dw-rounded-box tw-dw-p-6 tw-dw-max-w-md">
                <div class="tw-flex tw-flex-col rounded-2xl tw-dw-p-6 tw-dw-max-w-md text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-mx-auto tw-mb-4 icon icon-tabler icon-tabler-shield-lock" width="60" height="60" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3" />
                        <path d="M12 11m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                        <path d="M12 12l0 2.5" />
                    </svg>
                    <h1 class="tw-text-lg md:tw-text-xl tw-font-semibold tw-text-[#1e1e1e]">
                        SuperAdmin Verification Required
                    </h1>
                    <h2 class="tw-text-sm tw-font-medium tw-text-gray-500 tw-mt-2">
                        Please enter SuperAdmin credentials to proceed with registration
                    </h2>
                </div>

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ session('success') }}
                    </div>
                @endif

                {!! Form::open(['url' => route('business.postVerifySuperAdmin'), 'method' => 'post', 'id' => 'superadmin_verify_form']) !!}
                
                <div class="form-group">
                    <label for="superadmin_username">SuperAdmin Username <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </span>
                        {!! Form::text('superadmin_username', null, [
                            'class' => 'form-control',
                            'placeholder' => 'Enter SuperAdmin Username',
                            'required',
                            'autofocus'
                        ]); !!}
                    </div>
                    @if($errors->has('superadmin_username'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('superadmin_username') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="superadmin_password">SuperAdmin Password <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-lock"></i>
                        </span>
                        {!! Form::password('superadmin_password', [
                            'class' => 'form-control',
                            'placeholder' => 'Enter SuperAdmin Password',
                            'required'
                        ]); !!}
                    </div>
                    @if($errors->has('superadmin_password'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('superadmin_password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group tw-mt-4">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">
                        <i class="fa fa-check"></i> Verify & Proceed to Registration
                    </button>
                </div>

                <div class="text-center tw-mt-3">
                    <p class="text-muted">
                        <i class="fa fa-info-circle"></i> 
                        Verification is valid for 30 minutes
                    </p>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#superadmin_verify_form').submit(function(e) {
                // Add loading state to button
                var submitBtn = $(this).find('button[type="submit"]');
                var originalText = submitBtn.html();
                submitBtn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Verifying...');
                
                // Form will submit normally, just showing loading state
                setTimeout(function() {
                    submitBtn.prop('disabled', false).html(originalText);
                }, 3000);
            });
        });
    </script>
@stop
