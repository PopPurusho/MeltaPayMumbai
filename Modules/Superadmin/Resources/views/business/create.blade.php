@extends('layouts.app')
@section('title', 'Add Business')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Add new Business <small>Create a new business</small></h1>
</section>

<!-- Main content -->
<section class="content">

    @if(session('status'))
        @if(session('status')['success'] == 1)
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-check-circle"></i> {{ session('status')['msg'] }}
            </div>
        @else
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-times-circle"></i> {{ session('status')['msg'] }}
            </div>
        @endif
    @endif
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::open(['url' => route('superadmin.business.store'), 'method' => 'post', 'id' => 'business_register_form','files' => true ]) !!}
    
    <div class="box box-solid">
        <div class="box-body">
            @include('business.partials.register_form')
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary pull-right">@lang('messages.save')</button>
        </div>
    </div>

    {!! Form::close() !!}
</section>
@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function(){
        $('.start-date-picker').datepicker({
            autoclose: true,
            endDate: 'today'
        });
        $('.select2_register').select2();
    });
</script>
@endsection
