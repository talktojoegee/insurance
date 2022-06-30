@extends('layouts.master')

@section('title')
    Add New Employee
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
                                    <img class="img-fluid img-radius" src="\assets\images\user-card\img-round1.jpg" alt="round-img">
                                </div>
                                <div class="user-content">
                                    <h4 class="">{{$employee->first_name ?? ''}} {{$employee->last_name ?? ''}}</h4>
                                    <p class="m-b-0 text-muted">{{$employee->employeeJobRole->job_role ?? ''}}</p>
                                    <p class="m-b-0 text-info">{{ $employee->employeeDepartment->name ?? '' }}</p>
                                </div>
                            </div>
                            @if(Auth::user()->id == $employee->id)
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">Change Profile Picture</button>
                                </div>
                            @endif
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
                                                                <td><a href="#!">O+</a></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Genotype</th>
                                                                <td><a href="#!">AA</a></td>
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
    <div class="modal fade" id="deactivateAccountModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title">Deactivate Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('update-employee-account-status')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <input  type="hidden" value="{{$employee->id}}" placeholder="Enter Mobile No." name="employeeId" class="form-control">
                            <input type="hidden" name="status" value="2">
                        </div>
                        <div class="form-group">
                            <p>Are you sure you want to <code>Deactivate</code> {{$employee->first_name ?? '' }}'s account?</p>
                        </div>
                        <div class="form-group d-flex justify-content-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm  btn-default waves-effect " data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-sm btn-primary waves-effect waves-light ">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="activateAccountModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title">Activate Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('update-employee-account-status')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <input  type="hidden" value="{{$employee->id}}" placeholder="Enter Mobile No." name="employeeId" class="form-control">
                            <input type="hidden" name="status" value="1">
                        </div>
                        <div class="form-group">
                            <p>Are you sure you want to <code>Activate</code> {{$employee->first_name ?? '' }}'s account?</p>
                        </div>
                        <div class="form-group d-flex justify-content-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm  btn-default waves-effect " data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-sm btn-primary waves-effect waves-light ">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-script')

@endsection
