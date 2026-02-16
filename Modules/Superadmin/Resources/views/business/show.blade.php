@extends('layouts.app')
@section('title', 'Superadmin - Manage Business')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header tw-p-4 tw-mb-4">
    <h1 class="tw-text-2xl tw-font-bold tw-text-gray-800">Manage Business: <small class="tw-text-gray-500 tw-text-sm">{{$business->name}}</small></h1>
</section>

<!-- Main content -->
<section class="content tw-p-4">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#users_list_tab" data-toggle="tab" aria-expanded="true">
                            <i class="fa fa-users" aria-hidden="true"></i> Business Users
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="users_list_tab">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="business_users_table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="tw-bg-gray-100 tw-text-gray-600">Name</th>
                                        <th class="tw-bg-gray-100 tw-text-gray-600">Username</th>
                                        <th class="tw-bg-gray-100 tw-text-gray-600">Email</th>
                                        <th class="tw-bg-gray-100 tw-text-gray-600">Role</th>
                                        <th class="tw-bg-gray-100 tw-text-gray-600">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{$user->user_full_name}}</td>
                                            <td>{{$user->username}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->roles->pluck('name')->implode(', ')}}</td>
                                            <td>
                                                <a href="{{ route('sign-in-as-user', $user->id) }}?save_current=1" class="btn btn-success btn-xs">
                                                    <i class="fa fa-user-secret"></i> Login as {{$user->username}}
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function(){
        $('#business_users_table').DataTable();
    });
</script>
@endsection
