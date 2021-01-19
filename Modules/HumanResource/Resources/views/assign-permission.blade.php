@extends('layouts.master')

@section('title')
    Assign Permissions
@endsection

@section('current-page')
    Manage Permissions
@endsection
@section('current-page-brief')
Assign Permissions to {{$role->name ?? ''}}
@endsection
@section('main-content')
<div class="row">
    <div class="col-xl-12 col-lg-12  filter-bar">
        <nav class="navbar navbar-light bg-faded m-b-30 p-10">
            <div class="nav-item nav-grid">
                <a href="{{ url('/human-resource/add-new-employee') }}" class="btn btn-primary btn-mini waves-effect waves-light"><i class="ti-plus mr-2"></i>Add New Employee</a>
            </div>
        </nav>
    </div>
</div>
@if (session()->has('success'))
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="alert alert-success background-success" role="alert">
            {!! session()->get('success') !!}
        </div>
    </div>
</div>
@endif
<div class="card">
    <div class="card-block">
        <div class="row m-b-30">
            <div class="col-lg-12 col-xl-12">
                <form action="{{url('/human-resource/assign-permissions')}}" method="post">
                    @csrf
                    <div class="sub-title">Assign Permissions to <label for="" class="label label-info">{{$role->name ?? ''}}</label></div>
                    <div class="row mb-4">
                        @foreach ($permissions as $permit)
                            <div class="col-md-3">
                                <div class="checkbox-fade fade-in-primary">
                                    <label>
                                        <input type="checkbox" name="permission[]" {{$role->hasPermissionTo($permit->id) ? 'checked' : ''}} value="{{$permit->id}}">
                                        <span class="cr">
                                            <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                        </span>
                                        <span>{{$permit->name ?? ''}}</span>
                                    </label>
                                </div>
                            </div>

                        @endforeach
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center">
                            <input type="hidden" name="role" value="{{$role->id}}">
                            <div class="btn-group">
                                <a href="{{url('/human-resource/manage-roles-and-permissions')}}" class="btn btn-danger btn-mini"><i class="ti-close mr-2"></i>Cancel</a>
                                <button class="btn btn-primary btn-mini" type="submit"><i class="ti-check mr-2"></i>Save changes</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>
@endsection

@section('dialog-section')
<div class="modal fade" id="editRoleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h6 class="modal-title text-uppercase">Edit Role</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <label for="">Role Name</label>
                        <input type="text" placeholder="Role Name" id="role_name" name="role_name" class="form-control">
                        <input type="hidden" id="role_id" name="role_id" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"><i class="mr-2 ti-close"></i>Close</button>
                    <button type="button" class="btn btn-primary waves-effect btn-mini waves-light" id="editRoleBtn"><i class="mr-2 ti-check"></i>Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editPermissionModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h6 class="modal-title text-uppercase">Edit Permission</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <label for="">Permission Name</label>
                        <input type="text" placeholder="Permission Name" id="permission_name" name="permission_name" class="form-control">
                        <input type="hidden" id="permission_id" name="permission_id" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"><i class="mr-2 ti-close"></i>Close</button>
                    <button type="button" class="btn btn-primary waves-effect btn-mini waves-light" id="editPermissionBtn"><i class="mr-2 ti-check"></i>Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
<script src="/assets/js/axios.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.role').on('click', function(e){
                e.preventDefault();
                var role = $(this).data('role-name');
                var id = $(this).data('role-id');
                $('#role_name').val(role);
                $('#role_id').val(id);
            });
            $('.permission').on('click', function(e){
                e.preventDefault();
                var permission = $(this).data('permission-name');
                var id = $(this).data('permission-id');
                $('#permission_name').val(role);
                $('#permission_id').val(id);
            });

            $(document).on('click', '#editRoleBtn', function(e){
                e.preventDefault();
                axios.post('/human-resource/application/edit-role',{role_id:$('#role_id').val(), role_name:$('#role_name').val()})
                .then(response=>{
                    location.reload();
                });
            });
            $(document).on('click', '#editPermissionBtn', function(e){
                e.preventDefault();
                axios.post('/human-resource/application/edit-permission',{permission_id:$('#permission_id').val(), permission_name:$('#permission_name').val()})
                .then(response=>{
                    location.reload();
                });
            });
        });
    </script>
@endsection
