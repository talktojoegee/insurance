@extends('layouts.master')

@section('title')
    HR Settings
@endsection

@section('current-page')
    Human Resource Settings
@endsection
@section('current-page-brief')
Human Resource Settings
@endsection
@section('extra-styles')
<link rel="stylesheet" href="/assets/css/datatables.min.css">
@endsection
@section('main-content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card">
                <div class="card-block">
                    <div class="col-lg-12 col-xl-12">
                        <div class="sub-title">HR Settings</div>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs  tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#home1" role="tab">Departments</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#profile1" role="tab">Job Role</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#messages1" role="tab">Emp. Types</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#settings1" role="tab">Leave Type</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#settings2" role="tab">Acad. Qualification</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#settings3" role="tab">Grade</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#settings3" role="tab">Access Level</a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content tabs card-block">
                            <div class="tab-pane active" id="home1" role="tabpanel">
                                <h5 class="sub-title">Departments</h5>
                                <button type="button" class="btn btn-mini btn-primary"><i class="ti-plus mr-2"></i>Add New Department</button>
                                <div class="clear-both mt-4"></div>
                                <table class="table table-bordered mb-4" id="departmentTable">
                                    <thead>
                                        <tr>
                                            <th >#</th>
                                            <th >Department</th>
                                            <th >Added By</th>
                                            <th >Date</th>
                                            <th >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $d = 1;
                                        @endphp
                                        @foreach($departments as $department)
                                            <tr >
                                                <td >{{$d++}}</td>
                                                <td >{{$department->name ?? ''}}</td>
                                                <td >{{$department->addedBy->first_name ?? ''}} {{$department->addedBy->last_name ?? ''}}</td>
                                                <td >{{date('d F, Y', strtotime($department->created_at))}}</td>
                                                <td >
                                                    <div >
                                                        <a data-department="{{$department->name ?? ''}}" class="flex items-center mr-3 edit-department" href="javascript:void(0);"> <i data-feather="edit-3" class="w-4 h-4 mr-1"></i> Edit </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="profile1" role="tabpanel">
                                <h5 class="sub-title">Job Roles</h5>
                                <button type="button" class="btn btn-mini btn-primary"><i class="ti-plus mr-2"></i>Add New Job Role</button>
                                <div class="clear-both mt-4"></div>
                                <table class="table table-bordered " id="jobRoleTable">
                                    <thead>
                                        <tr>
                                            <th >#</th>
                                            <th >Job Role</th>
                                            <th >Department</th>
                                            <th >Added By</th>
                                            <th >Date</th>
                                            <th >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $r = 1;
                                        @endphp
                                        @foreach($roles as $role)
                                            <tr >
                                                <td >{{$r++}}</td>
                                                <td >{{$role->job_role ?? ''}}</td>
                                                <td > {{$role->roleDepartment->name ?? ''}}</td>
                                                <td >
                                                        {{$role->addedBy->first_name ?? ''}} {{$role->addedBy->last_name ?? ''}}
                                                </td>
                                                <td >{{date('d F, Y', strtotime($role->created_at))}}</td>
                                                <td >
                                                    <div class="flex justify-center items-center">
                                                        <a class="flex items-center mr-3" href="javascript:;"> <i data-feather="edit-3" class="w-4 h-4 mr-1"></i> Edit </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="settings1" role="tabpanel">
                                leave type
                            </div>
                            <div class="tab-pane" id="messages1" role="tabpanel">
                                <h5 class="sub-title">Employment Types</h5>
                                <button type="button" class="btn btn-mini btn-primary"><i class="ti-plus mr-2"></i>Add New Employment Type</button>
                                <div class="clear-both mt-4"></div>
                                <table class="table table-bordered" id="employmentTypeTable">
                                    <thead>
                                        <tr>
                                            <th >#</th>
                                            <th >Employment Type</th>
                                            <th >Added By</th>
                                            <th >Date</th>
                                            <th >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $t = 1;
                                        @endphp
                                        @foreach($emp_types as $type)
                                            <tr >
                                                <td >{{$t++}}</td>
                                                <td >{{$type->name ?? ''}}</td>
                                                <td >{{$type->addedBy->first_name ?? ''}} {{$type->addedBy->last_name ?? ''}}</td>
                                                <td >{{date('d F, Y', strtotime($type->created_at))}}</td>
                                                <td >
                                                    <div class="flex justify-center items-center">
                                                        <a class="flex items-center mr-3" href="javascript:;"> <i data-feather="edit-3" class="w-4 h-4 mr-1"></i> Edit </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="settings2" role="tabpanel">
                                <h5 class="sub-title">Academic Qualification</h5>
                                <button type="button" class="btn btn-mini btn-primary"><i class="ti-plus mr-2"></i>Add New Academic Qualification</button>
                                <div class="clear-both mt-4"></div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th >#</th>
                                            <th >Qualification</th>
                                            <th >Added By</th>
                                            <th >Date</th>
                                            <th >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $q = 1;
                                        @endphp
                                        @foreach($qualifications as $qualify)
                                            <tr >
                                                <td >{{$q++}}</td>
                                                <td >{{$qualify->name ?? ''}}</td>
                                                <td >{{$qualify->addedBy->first_name ?? ''}} {{$qualify->addedBy->last_name ?? ''}}</td>
                                                <td >{{date('d F, Y', strtotime($qualify->created_at))}}</td>
                                                <td >
                                                    <div class="flex justify-center items-center">
                                                        <a class="flex items-center mr-3" href="javascript:;"> <i data-feather="edit-3" class="w-4 h-4 mr-1"></i> Edit </a>
                                                    </div>
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

@endsection

@section('dialog-section')
    <div class="modal" id="new-department-modal">
        <div class="modal__content">
            <div class="p-5 text-center">
                <form action="" class="validate-form">
                    <div class="intro-y flex items-center mt-8">
                        <h2 class="text-lg font-medium mr-auto">
                            Add New Department
                        </h2>
                    </div>
                    <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">
                        <div class="intro-y col-span-12 sm:col-span-12">
                            <div class="input-form mb-2">
                                <label for="" class="flex flex-col sm:flex-row">Department</label>
                                <input type="text" required class="input w-full border flex-1" name="department" id="department" placeholder="Department">
                            </div>
                        </div>
                    </div>
                    <div class="intro-y col-span-12 flex items-center justify-center sm:justify-center mt-5">
                        <button class="button w-24 justify-center button--sm block bg-theme-6 text-white">Cancel</button>
                        <button class="button w-24 justify-center button--sm block bg-theme-1 text-white ml-2" id="addNewDepartmentBtn" type="submit">Submit</button>
                        <button style="display: none;" class="button w-24 justify-center button--sm block bg-theme-1 text-white ml-2" id="saveDepartmentChanges" type="submit">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="new-leave-type-modal">
        <div class="modal__content">
            <div class="p-5 text-center">
                <form action="" class="validate-form">
                    <div class="intro-y flex items-center mt-8">
                        <h2 class="text-lg font-medium mr-auto">
                            Add New Leave Type
                        </h2>
                    </div>
                    <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">
                        <div class="intro-y col-span-12 sm:col-span-12">
                            <div class="input-form mb-2">
                                <label for="" class="flex flex-col sm:flex-row">Leave Name</label>
                                <input type="text" required class="input w-full border flex-1" name="leave_name" placeholder="Leave Name">
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">
                        <div class="intro-y col-span-12 sm:col-span-12">
                            <div class="input-form mb-2">
                                <label for="" class="flex flex-col sm:flex-row">Duration</label>
                                <input type="number" required class="input w-full border flex-1" name="duration" placeholder="Leave Duration">
                            </div>
                        </div>
                    </div>
                    <div class="intro-y col-span-12 flex items-center justify-center sm:justify-center mt-5">
                        <button class="button w-24 justify-center button--sm block bg-theme-6 text-white">Cancel</button>
                        <button class="button w-24 justify-center button--sm block bg-theme-1 text-white ml-2" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="new-role-modal">
        <div class="modal__content">
            <div class="p-5 text-center">
                <form action="" class="validate-form">
                    <div class="intro-y flex items-center mt-8">
                        <h2 class="text-lg font-medium mr-auto">
                            Add New Role
                        </h2>
                    </div>
                    <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">
                        <div class="intro-y col-span-12 sm:col-span-12">
                            <div class="input-form mb-2">
                                <label for="" class="flex flex-col sm:flex-row">Role Name</label>
                                <input type="text" required class="input w-full border flex-1" id="role_name" name="role_name" placeholder="Role Name">
                            </div>
                        </div>
                    </div>
                    <div class="intro-y col-span-12 flex items-center justify-center sm:justify-center mt-5">
                        <button class="button w-24 justify-center button--sm block bg-theme-6 text-white">Cancel</button>
                        <button class="button w-24 justify-center button--sm block bg-theme-1 text-white ml-2" id="applicationRoleAccessLevelBtn" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="new-employment-type-modal">
        <div class="modal__content">
            <div class="p-5 text-center">
                <form action="" class="validate-form">
                    <div class="intro-y flex items-center mt-8">
                        <h2 class="text-lg font-medium mr-auto">
                            Add New Employment Type
                        </h2>
                    </div>
                    <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">
                        <div class="intro-y col-span-12 sm:col-span-12">
                            <div class="input-form mb-2">
                                <label for="" class="flex flex-col sm:flex-row">Employment Type Name</label>
                                <input type="text" required class="input w-full border flex-1" name="employment_type_name" id="employment_type_name" placeholder="Employment Type Name(Ex. Probation)">
                            </div>
                        </div>
                    </div>
                    <div class="intro-y col-span-12 flex items-center justify-center sm:justify-center mt-5">
                        <button class="button w-24 justify-center button--sm block bg-theme-6 text-white">Cancel</button>
                        <button id="saveEmploymentTypeBtn" class="button w-24 justify-center button--sm block bg-theme-1 text-white ml-2" type="submit">Submit</button>
                        <button style="display: none;" id="saveEmploymentTypeChangesBtn" class="button w-24 justify-center button--sm block bg-theme-1 text-white ml-2" type="submit">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="new-job-role-modal">
        <div class="modal__content">
            <div class="p-5 text-center">
                <form action="" class="validate-form">
                    <div class="intro-y flex items-center mt-8">
                        <h2 class="text-lg font-medium mr-auto">
                            Add New Job Role
                        </h2>
                    </div>
                    <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">
                        <div class="intro-y col-span-12 sm:col-span-12">
                            <div class="input-form mb-2">
                                <label for="" class="flex flex-col sm:flex-row">Job Role</label>
                                <input type="text" required class="input w-full border flex-1" name="job_role" id="job_role" placeholder="Job Role">
                            </div>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-12">
                            <div class="input-form mb-2">
                                <label for="" class="flex flex-col sm:flex-row"> Department</label>
                                <select class="input w-full border flex-1" name="select_department" id="select_department" required>
                                    <option disabled selected>Select department</option>
                                    @foreach($departments as $depart)
                                        <option value="{{$depart->id ?? 1}}">{{$depart->name ?? ''}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-12">
                            <div class="input-form mb-2">
                                <label for="" class="flex flex-col sm:flex-row">Description</label>
                                <textarea class="input w-full border flex-1" style="resize: none;" id="role_description" name="role_description" required placeholder="Role Description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="intro-y col-span-12 flex items-center justify-center sm:justify-center mt-5">
                        <button class="button w-24 justify-center button--sm block bg-theme-6 text-white">Cancel</button>
                        <button class="button w-24 justify-center button--sm block bg-theme-1 text-white ml-2" id="jobRoleBtn" type="submit">Submit</button>
                        <button style="display: none;" class="button w-24 justify-center button--sm block bg-theme-1 text-white ml-2" id="saveJobRoleChangesBtn" type="submit">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="new-academic-qualification-modal">
        <div class="modal__content">
            <div class="p-5 text-center">
                <form action="" class="validate-form">
                    <div class="intro-y flex items-center mt-8">
                        <h2 class="text-lg font-medium mr-auto">
                            Add New Academic Qualification
                        </h2>
                    </div>
                    <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">
                        <div class="intro-y col-span-12 sm:col-span-12">
                            <div class="input-form mb-2">
                                <label for="" class="flex flex-col sm:flex-row">Qualification</label>
                                <input type="text" required class="input w-full border flex-1" name="qualification" id="qualification" placeholder="Academic Qualification">
                            </div>
                        </div>
                    </div>
                    <div class="intro-y col-span-12 flex items-center justify-center sm:justify-center mt-5">
                        <button class="button w-24 justify-center button--sm block bg-theme-6 text-white">Cancel</button>
                        <button class="button w-24 justify-center button--sm block bg-theme-1 text-white ml-2" id="saveAcademicQualificationBtn" type="submit">Submit</button>
                        <button style="display: none;" class="button w-24 justify-center button--sm block bg-theme-1 text-white ml-2" id="saveAcademicQualificationChangesBtn" type="submit">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')
<script src="/assets/js/datatables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#departmentTable').DataTable();
            $('#jobRoleTable').DataTable();
            $('#employmentTypeTable').DataTable();
            //New department
            $(document).on('click', '#addNewDepartmentBtn', function(e){
                axios.post('/human-resource/add-new-department', {name:$('#department').val()})
                .then(response=>{
                    Toastify({ node: $( "<strong>"+response.data.message+"</strong>" )[0], duration: 3000, newWindow: true, close: true, gravity: "top", position: "right", backgroundColor: "#91C714", stopOnFocus: true }).showToast();
                    $('#new-department-modal').modal('hide');
                    location.reload();
                })
                .catch(error=>{
                    Toastify({ node: $( "<strong>"+error.data.errors.error+"</strong>" )[0], duration: 3000, newWindow: true, close: true, gravity: "top", position: "right", backgroundColor: "#FF0000", stopOnFocus: true }).showToast();
                });
            });
            //Edit department
            $(document).on('click', '.edit-department', function(event){
                event.preventDefault();
                var department = $(this).data('department');
                $('#department').val(department);
                $('#new-department-modal').modal('show');
                $('#addNewDepartmentBtn').hide();
                $('#saveDepartmentChanges').show();
            });
            //New job role
            $(document).on('click', '#jobRoleBtn', function(e){
                axios.post('/human-resource/add-new-job-role', {
                    role:$('#job_role').val(),
                    department:$('#select_department').val(),
                    description:$('#role_description').val()
                })
                .then(response=>{
                    Toastify({ node: $( "<strong>"+response.data.message+"</strong>" )[0], duration: 3000, newWindow: true, close: true, gravity: "top", position: "right", backgroundColor: "#91C714", stopOnFocus: true }).showToast();
                    $('#new-job-role-modal').modal('hide');
                    location.reload();
                })
                .catch(error=>{
                    Toastify({ node: $( "<strong>"+error.data.errors.error+"</strong>" )[0], duration: 3000, newWindow: true, close: true, gravity: "top", position: "right", backgroundColor: "#FF0000", stopOnFocus: true }).showToast();
                });
            });
            //Edit job role
            $(document).on('click', '.edit-department', function(event){
                event.preventDefault();
                var department = $(this).data('department');
                $('#department').val(department);
                $('#new-department-modal').modal('show');
                $('#addNewDepartmentBtn').hide();
                $('#saveDepartmentChanges').show();
            });
            //New employment type
            $(document).on('click', '#saveEmploymentTypeBtn', function(e){
                axios.post('/human-resource/add-new-employment-type', {
                    name:$('#employment_type_name').val()
                })
                .then(response=>{
                    Toastify({ node: $( "<strong>"+response.data.message+"</strong>" )[0], duration: 3000, newWindow: true, close: true, gravity: "top", position: "right", backgroundColor: "#91C714", stopOnFocus: true }).showToast();
                    $('#new-job-role-modal').modal('hide');
                    location.reload();
                })
                .catch(error=>{
                    Toastify({ node: $( "<strong>"+error.data.errors.error+"</strong>" )[0], duration: 3000, newWindow: true, close: true, gravity: "top", position: "right", backgroundColor: "#FF0000", stopOnFocus: true }).showToast();
                });
            });
            //Edit job role
            $(document).on('click', '.edit-department', function(event){
                event.preventDefault();
                var department = $(this).data('department');
                $('#department').val(department);
                $('#new-department-modal').modal('show');
                $('#addNewDepartmentBtn').hide();
                $('#saveDepartmentChanges').show();
            });
            //New academic qualification
            $(document).on('click', '#saveAcademicQualificationBtn', function(e){
                axios.post('/human-resource/add-new-academic-qualification', {
                    name:$('#qualification').val()
                })
                .then(response=>{
                    Toastify({ node: $( "<strong>"+response.data.message+"</strong>" )[0], duration: 3000, newWindow: true, close: true, gravity: "top", position: "right", backgroundColor: "#91C714", stopOnFocus: true }).showToast();
                    $('#new-academic-qualification-modal').modal('hide');
                    location.reload();
                })
                .catch(error=>{
                    Toastify({ node: $( "<strong>"+error.data.errors.error+"</strong>" )[0], duration: 3000, newWindow: true, close: true, gravity: "top", position: "right", backgroundColor: "#FF0000", stopOnFocus: true }).showToast();
                });
            });
            //Edit academic qualification
            $(document).on('click', '.edit-department', function(event){
                event.preventDefault();
                var department = $(this).data('department');
                $('#department').val(department);
                $('#new-department-modal').modal('show');
                $('#addNewDepartmentBtn').hide();
                $('#saveDepartmentChanges').show();
            });

            //Application role
            $(document).on('click', '#applicationRoleAccessLevelBtn', function(e){
                e.preventDefault();
                axios.post('/human-resource/application/role', {role_name:$('#role_name').val()})
                .then(response=>{
                    Toastify({
                    text: response.data.message,

                    duration: 3000

                    }).showToast();
                })
                .catch(error=>{
                    console.log(error.data.errors);
                });
            });
        });
    </script>
@endsection
