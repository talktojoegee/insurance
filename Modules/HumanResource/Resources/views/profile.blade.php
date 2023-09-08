@extends('layouts.master')

@section('title')
    Profile
@endsection

@section('current-page')
    {{$employee->first_name ?? ''}} {{$employee->last_name ?? ''}}
@endsection
@section('current-page-brief')
Profile
@endsection
@section('main-content')
    @include('humanresource::partials._employee-shortcut')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-block">
                {!! $employee->account_status == 1 ? "<span class='badge badge-success'>Active</span>" : "<span class='badge badge-danger'>Deactivated</span>" !!}
                <div class="row mt-3">
                    <div class="col-md-3 col-lg-3">
                        <div class="card rounded-card user-card">
                            <div class="card-block">
                                <div class="img-hover">
                                    @if($employee->avatar == 'avatar.png' && $employee->gender == 1)
                                        <img class="img-fluid img-radius" src="\assets\images\male.jpeg" alt="round-img">
                                    @elseif($employee->avatar == 'avatar.png' && $employee->gender == 2)
                                        <img class="img-fluid img-radius" src="\assets\images\female.jpeg" alt="round-img">
                                    @else
                                        <img class="img-fluid img-radius" src="{{url('storage/'.$employee->avatar)}}" alt="round-img">
                                    @endif
                                </div>
                                <div class="user-content">
                                    <h4 class="">{{$employee->first_name ?? ''}} {{$employee->last_name ?? ''}}</h4>
                                    <p class="m-b-0 text-muted">{{$employee->employeeJobRole->job_role ?? ''}}</p>
                                    <p class="m-b-0 text-info">{{ $employee->employeeDepartment->name ?? '' }}</p>
                                </div>
                            </div>
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
                                                                <td>{{$employee->roles->first()->name ?? ''}}</td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-xl-6">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>

                                                            <tr>
                                                                <th scope="row">State</th>
                                                                <td>{{$employee->getEmployeeState->state_name ?? '' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">LGA</th>
                                                                <td>{{$employee->getEmployeeLocalGovernment->local_name ?? '' }}</td>
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
                                                                <td><a href="#!">{{ $employee->getBloodGroup->name ?? '' }}</a></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Known Ailment</th>
                                                                <td>{{$employee->known_ailment ?? ''}}</td>
                                                            </tr>
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
    </div>
</div>
    @include('humanresource::partials._deactivate-account-modal')
    @include('humanresource::partials._activate-account-modal')
    @include('humanresource::partials._permission-modal')
@endsection

@section('extra-script')

@endsection
