@extends('layouts.auth2')
@section('title', __('lang_v1.register'))

@section('content')

    <div class="row" style="display:flex; justify-content:center;">
        <div class="col-md-8 col-xs-12" style="max-width:800px; width:100%;">
            <div class="auth-card">
                {{-- Header --}}
                <div style="text-align:center; margin-bottom:28px;">
                    <div style="width:56px; height:56px; border-radius:16px; background:linear-gradient(135deg, rgba(52,211,153,0.12), rgba(99,102,241,0.12)); display:inline-flex; align-items:center; justify-content:center; margin-bottom:16px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="8.5" cy="7" r="4"/>
                            <line x1="20" y1="8" x2="20" y2="14"/>
                            <line x1="23" y1="11" x2="17" y2="11"/>
                        </svg>
                    </div>
                    <h1 class="auth-title">{{ config('app.name', 'ultimatePOS') }}</h1>
                    <p class="auth-subtitle">@lang('business.register_and_get_started_in_minutes')</p>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="fa fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                {!! Form::open([
                    'url' => route('business.postRegister'),
                    'method' => 'post',
                    'id' => 'business_register_form',
                    'files' => true,
                ]) !!}
                @include('business.partials.register_form')
                {!! Form::hidden('package_id', $package_id) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.change_lang').click(function() {
                window.location = "{{ route('business.getRegister') }}?lang=" + $(this).attr('value');
            });
        })
    </script>
@endsection
