@extends('layouts.app')
@section('title', 'Superadmin - Businesses')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header tw-p-4 tw-mb-4">
    <h1 class="tw-text-2xl tw-font-bold tw-text-gray-800">Superadmin <small class="tw-text-gray-500 tw-text-sm">Manage Application</small></h1>
</section>

<!-- Main content -->
<section class="content tw-p-4">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#business_list_tab" data-toggle="tab" aria-expanded="true">
                            <i class="fa fa-list" aria-hidden="true"></i> All Businesses
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="business_list_tab">
                        <div class="box-tools pull-right" style="margin-bottom: 10px;">
                            <a href="{{ action([\Modules\Superadmin\Http\Controllers\BusinessController::class, 'create']) }}" class="btn btn-block btn-primary">
                                <i class="fa fa-plus"></i> Add New Business
                            </a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="superadmin_business_table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="tw-bg-gray-100 tw-text-gray-600">ID</th>
                                        <th class="tw-bg-gray-100 tw-text-gray-600">Business Name</th>
                                        <th class="tw-bg-gray-100 tw-text-gray-600">Owner</th>
                                        <th class="tw-bg-gray-100 tw-text-gray-600">Registered On</th>
                                        <th class="tw-bg-gray-100 tw-text-gray-600">Status</th>
                                        <th class="tw-bg-gray-100 tw-text-gray-600">Action</th>
                                    </tr>
                                </thead>
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
        var superadmin_business_table = $('#superadmin_business_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/superadmin/business',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'owner_name', name: 'owner_name', searchable: false},
                {data: 'created_at', name: 'created_at'},
                {data: 'is_active', name: 'is_active'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $(document).on('click', '.delete-business', function(e) {
            e.preventDefault();
            swal({
                title: 'Are you sure?',
                text: "Once deleted, you will not be able to recover this business!",
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    var data = {
                        _method: 'DELETE',
                        _token: $('meta[name="csrf-token"]').attr('content')
                    };
                    $.ajax({
                        method: 'POST',
                        url: $(this).data('href'),
                        dataType: 'json',
                        data: data,
                        success: function(result) {
                            if (result.success === true) {
                                toastr.success(result.msg);
                                superadmin_business_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
