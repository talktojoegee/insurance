@extends('layouts.master')

@section('title')
    Add New Employee
@endsection

@section('current-page')
    Profile
@endsection
@section('current-page-brief')
Profile
@endsection
@section('main-content')
<div class="row">
    <div class="col-xl-12 col-lg-12  filter-bar">
        <nav class="navbar navbar-light bg-faded m-b-30 p-10">
            <div class="nav-item nav-grid">
                <a href="{{ url('/human-resource') }}" class="btn btn-primary btn-mini waves-effect waves-light"><i class="icofont icofont-users-alt-3 mr-2"></i>Manage Employees</a>
            </div>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-block">
                <h5 class="sub-title text-primary">{{$employee->first_name ?? ''}}'s Profile</h5>
                <div class="row">
                    <div class="col-md-3 col-lg-3">

                        <ul class="list-group list-contacts">
                            <li class="list-group-item">
                                <img class="img-radius img-40" src="\assets\images\avatar-4.jpg" alt="contact-user">
                            </li>
                            <li class="list-group-item"><a href="#">{{$employee->first_name ?? ''}} {{$employee->last_name ?? ''}}</a></li>
                            <li class="list-group-item"><a href="#">{{$employee->employeeJobRole->job_role ?? ''}}</a></li>
                            <li class="list-group-item"><a href="#">{{ $employee->employeeDepartment->name ?? '' }}</a></li>
                        </ul>
                        <div class="btn-group mt-3 " role="group" >
                            <button type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Terminate {{$employee->first_name."'s" ?? ''}} Employment" class="btn btn-danger btn-mini waves-effect waves-light"><i class="ti-close"></i>Terminate</button>
                            <button type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Profile" class="btn btn-warning btn-mini waves-effect waves-light"><i class="ti-pencil"></i>Edit</button>
                            <button type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Query {{$employee->first_name ?? ''}}" class="btn btn-secondary btn-mini waves-effect waves-light"><i class="ti-alert"></i>Query</button>
                        </div>
                    </div>
                    <div class="col-md-9 col-lg-9">
                        <div class="view-info">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="general-info">
                                        <div class="row">
                                            <div class="col-lg-12 col-xl-6">
                                                <div class="table-responsive">
                                                    <table class="table m-0">
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row">Full Name</th>
                                                                <td>{{$employee->first_name ?? ''}} {{$employee->last_name ?? ''}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Gender</th>
                                                                <td>{{$employee->gender == 1 ? 'Male' : 'Female'}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Email</th>
                                                                <td><a href="mailto:{{$employee->email ?? ''}}"><span class="">{{$employee->email ?? ''}}</span></a></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Mobile Number</th>
                                                                <td>{{$employee->mobile_no ?? ''}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Hire Date</th>
                                                                <td>{{date('d M, Y', strtotime($employee->hire_date))}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Marital Status</th>
                                                                <td>{{$employee->employeeMaritalStatus->name ?? ''}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Job Role</th>
                                                                <td>{{$employee->employeeJobRole->job_role ?? ''}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Address</th>
                                                                <td>{{$employee->address ?? ''}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Access Level</th>
                                                                <td>{{$employee->address ?? ''}}</td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- end of table col-lg-6 -->
                                            <div class="col-lg-12 col-xl-6">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>

                                                            <tr>
                                                                <th scope="row">State</th>
                                                                <td>@xyz</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">LGA</th>
                                                                <td>demo.skype</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Department</th>
                                                                <td><a href="javascript:void(0);">{{$employee->employeeDepartment->name ?? ''}}</a></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Academic Qualification</th>
                                                                <td>{{$employee->employeeAcademicQualification->name ?? ''}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Employment Type</th>
                                                                <td>{{$employee->employeeEmploymentType->name ?? ''}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Employee ID</th>
                                                                <td><a href="javascript:void(0);">{{$employee->employee_id ?? ''}}</a></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Blood Group</th>
                                                                <td><a href="#!">www.demo.com</a></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Genotype</th>
                                                                <td><a href="#!">www.demo.com</a></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Known Ailment</th>
                                                                <td>{{$employee->known_ailment ?? ''}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- end of table col-lg-6 -->
                                        </div>
                                        <!-- end of row -->
                                    </div>
                                    <!-- end of general info -->
                                </div>
                                <!-- end of col-lg-12 -->
                            </div>
                            <!-- end of row -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-script')

@endsection
