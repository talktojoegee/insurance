@extends('layouts.master')

@section('title')
    Employee Settings
@endsection

@section('current-page')
    Settings
@endsection
@section('current-page-brief')
    Employee Settings
@endsection
@section('main-content')
    @include('humanresource::partials._employee-shortcut')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-block">
                    @if (session()->has('success'))
                        <div class="alert alert-success background-success px-5 py-4 mb-2 bg-theme-12 text-white mb-2 mt-2">
                            {!! session()->get('success') !!}
                        </div>
                    @endif

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
                                            <form action="{{route('edit-employee-profile')}}" autocomplete="off" method="post">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-12 col-xl-6">
                                                        <div class="table-responsive">
                                                            <table class="table m-0">
                                                                <tbody>
                                                                <tr>
                                                                    <th scope="row">First Name</th>
                                                                    <td>
                                                                        <input name="firstName" type="text" value="{{$employee->first_name ?? ''}}" class="form-control">
                                                                        @error('firstName')
                                                                        <i class="text-danger">{{$message}}</i>
                                                                        @enderror
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Surname</th>
                                                                    <td>
                                                                        <input name="lastName" type="text" value="{{$employee->last_name ?? ''}}" class="form-control">
                                                                        @error('lastName')
                                                                        <i class="text-danger">{{$message}}</i>
                                                                        @enderror
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Gender</th>
                                                                    <td>
                                                                        <select name="gender" id="gender"
                                                                                class="form-control">
                                                                            <option value="1" {{$employee->gender == 1 ? 'selected' : ''}}>Male</option>
                                                                            <option value="2" {{$employee->gender == 2 ? 'selected' : ''}}>Female</option>
                                                                        </select>
                                                                        @error('gender')
                                                                        <i class="text-danger">{{$message}}</i>
                                                                    @enderror

                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Email</th>
                                                                    <td><a href="mailto:{{$employee->email ?? ''}}"><span class="">{{$employee->email ?? ''}}</span></a></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Mobile Number</th>
                                                                    <td>
                                                                        <input type="text" name="mobileNo" value="{{$employee->mobile_no ?? ''}}" class="form-control">
                                                                        @error('mobileNo')
                                                                        <i class="text-danger">{{$message}}</i>
                                                                        @enderror
                                                                    </td>
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
                                                                    <td>
                                                                        <span>{{$employee->employeeJobRole->job_role ?? ''}}</span>
                                                                        <select name="jobRole" id="jobRole"
                                                                                class="form-control">
                                                                            @foreach($jobRoles as $jRole)
                                                                                <option value="{{$jRole->id}}" {{$jRole->id == $employee->employeeJobRole->id ? 'selected' : ''}}>{{$jRole->job_role ?? '' }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('jobRole')
                                                                        <i class="text-danger">{{$message}}</i>
                                                                        @enderror
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Address</th>
                                                                    <td>
                                                                        <textarea name="address" placeholder="Type address here..." style="resize: none;"
                                                                                  class="form-control">{{$employee->address ?? ''}}</textarea>
                                                                        @error('address')
                                                                        <i class="text-danger">{{$message}}</i>
                                                                        @enderror
                                                                        <input type="hidden" name="empId" value="{{$employee->id}}">
                                                                    </td>
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
                                                                    <td>
                                                                        {{$employee->getEmployeeState->state_name ?? ''}}
                                                                        <select name="state" id="state"
                                                                                class="form-control">
                                                                            @foreach($states as $state )
                                                                                <option value="{{$state->id}}" {{$state->id == $employee->state ? 'selected' : '' }}>{{$state->state_name ?? '' }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('state')
                                                                            <i class="text-danger">{{$message}}</i>
                                                                        @enderror
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Department</th>
                                                                    <td>
                                                                        <a href="javascript:void(0);">{{$employee->employeeDepartment->name ?? ''}}</a>
                                                                        <select name="department" id="department"
                                                                                class="form-control">
                                                                            @foreach($departments as $department )
                                                                                <option value="{{$department->id}}" {{$department->id == $employee->department ? 'selected' : '' }}>{{$department->name ?? '' }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('department')
                                                                        <i class="text-danger">{{$message}}</i>
                                                                        @enderror
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Academic Qualification</th>
                                                                    <td>
                                                                        {{$employee->employeeAcademicQualification->name ?? ''}}
                                                                        <select name="qualification" id="qualification"
                                                                                class="form-control">
                                                                            @foreach($qualifications as $qualification )
                                                                                <option value="{{$qualification->id}}" {{$qualification->id == $employee->acadmic_qualification ? 'selected' : '' }}>{{$qualification->name ?? '' }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('qualification')
                                                                        <i class="text-danger">{{$message}}</i>
                                                                        @enderror
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Employment Type</th>
                                                                    <td>
                                                                        {{$employee->employeeEmploymentType->name ?? ''}}
                                                                        <select name="employmentType" id="employmentType"
                                                                                class="form-control">
                                                                            @foreach($employement_types as $type )
                                                                                <option value="{{$type->id}}" {{$type->id == $employee->employement_type ? 'selected' : '' }}>{{$type->name ?? '' }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('employmentType')
                                                                        <i class="text-danger">{{$message}}</i>
                                                                        @enderror
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Employee ID</th>
                                                                    <td>
                                                                        <input type="text" value="{{$employee->employee_id ?? ''}}" name="employeeId" placeholder="Employee ID" class="form-control">
                                                                        @error('employeeId')
                                                                        <i class="text-danger">{{$message}}</i>
                                                                        @enderror
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Blood Group</th>
                                                                    <td>
                                                                        <input type="text" value="{{$employee->blood_group ?? ''}}" name="bloodGroup" placeholder="Blood Group" class="form-control">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Genotype</th>
                                                                    <td>
                                                                        <input type="text" value="{{$employee->genotype ?? ''}}" name="genotype" placeholder="Genotype" class="form-control">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Known Ailment</th>
                                                                    <td>
                                                                        <input type="text" value="{{$employee->known_ailment ?? ''}}" name="knownAilment" placeholder="Known Ailment" class="form-control">

                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!-- end of table col-lg-6 -->
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 d-flex justify-content-center ">

                                                        <button class="btn btn-primary btn-sm" type="submit">Save Changes</button>
                                                    </div>
                                                </div>
                                            </form>
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
