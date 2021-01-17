@extends('layouts.master')

@section('title')
    Manage Roles & Permissions
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
                <div class="sub-title">Manage Roles & Permissions</div>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs md-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home3" role="tab">Roles</a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#profile3" role="tab">Permissions</a>
                        <div class="slide"></div>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content card-block">
                    <div class="tab-pane active" id="home3" role="tabpanel">
                        <div class="row">
                            <div class="col-md-4 col-lg-4">
                                <div class="card">
                                    <div class="card-block">
                                        <form action="{{url('/human-resource/application/role')}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="">Role Name</label>
                                                <input type="text" placeholder="Role Name" name="role_name" class="form-control">
                                                @error('role_name')
                                                    <i class="text-danger mt-3">{{$message}}</i>
                                                @enderror
                                            </div>
                                            <div class="form-group d-flex justify-content-center">
                                                <button class="btn btn-primary btn-mini" type="submit"><i class="ti-check mr-2"></i>Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-8">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="table-responsive mt-3">
                                            <table class="table table-hover table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Role Name</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $serial = 1;
                                                    @endphp
                                                    @foreach ($roles as $role)
                                                        <tr>
                                                            <th scope="row">{{$serial++}}</th>
                                                            <td>{{$role->name ?? ''}}</td>
                                                            <td>{{date('d M, Y', strtotime($role->created_at))}}</td>
                                                            <td class="text-center">
                                                                <a href="" class="role mr-4" data-toggle="modal" title="Edit Role"  data-placement="top" title="" data-original-title="Edit Role" data-target="#editRoleModal" data-role-name="{{$role->name ?? ''}}" data-role-id="{{$role->id}}"><i class="ti-pencil text-warning"></i></a>
                                                                <a href="" class=" mr-4"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Assign Permission(s)"><i class="ti-lock text-danger"></i></a>
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
                    <div class="tab-pane" id="profile3" role="tabpanel">
                        <div class="row">
                            <div class="col-md-4 col-lg-4">
                                <div class="card">
                                    <div class="card-block">
                                        <form action="{{url('/human-resource/application/permission')}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="">Permission Name</label>
                                                <input type="text" placeholder="Permission Name" name="permission_name" class="form-control">
                                                @error('permission_name')
                                                    <i class="text-danger mt-3">{{$message}}</i>
                                                @enderror
                                            </div>
                                            <div class="form-group d-flex justify-content-center">
                                                <button class="btn btn-primary btn-mini" type="submit"><i class="ti-check mr-2"></i>Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-8">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="table-responsive mt-3">
                                            <table class="table table-hover table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Permission Name</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $serial = 1;
                                                    @endphp
                                                    @foreach ($permissions as $permission)
                                                        <tr>
                                                            <th scope="row">{{$serial++}}</th>
                                                            <td>{{$permission->name ?? ''}}</td>
                                                            <td>{{date('d M, Y', strtotime($permission->created_at))}}</td>
                                                            <td class="text-center">
                                                                <a href="" class="permission" data-toggle="modal" data-target="#editPermissionModal" data-permission-name="{{$permission->name ?? ''}}" data-permission-id="{{$permission->id}}"><i class="ti-pencil text-warning"></i></a>
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
                </div>
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
