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

                        <div class="col-xl-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="nav nav-tabs md-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#home3" role="tab">Profile</a>
                                            <div class="slide"></div>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#profile3" role="tab">Change Password</a>
                                            <div class="slide"></div>
                                        </li>
                                    </ul>
                                    <div class="tab-content card-block">
                                        <div class="tab-pane active" id="home3" role="tabpanel">
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
                                                        @if(Auth::user()->id == $employee->id)
                                                            <form action="{{ route('change-profile-picture') }}" enctype="multipart/form-data" method="post">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <input type="file" name="profilePicture" class="form-control-file">
                                                                    <button type="submit" class="btn btn-primary btn-sm">Change Profile Picture</button>
                                                                </div>
                                                                @error('profilePicture') <i class="'text-danger">{{$message}}</i> @enderror
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-9 col-lg-9">
                                                    <div class="view-info">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="general-info">
                                                                    <form action="#" autocomplete="off" method="post">
                                                                        @csrf
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-xl-12">
                                                                                <div class="table-responsive">
                                                                                    <table class="table m-0">
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        for="">First Name</label>
                                                                                                    <input name="firstName" readonly type="text" value="{{$employee->first_name ?? ''}}" class="form-control">
                                                                                                    @error('firstName')
                                                                                                    <i class="text-danger">{{$message}}</i>
                                                                                                    @enderror
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        for="">Surname</label>
                                                                                                    <input name="lastName" readonly type="text" value="{{$employee->last_name ?? ''}}" class="form-control">
                                                                                                    @error('lastName')
                                                                                                    <i class="text-danger">{{$message}}</i>
                                                                                                    @enderror
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        for="">Email Address</label>
                                                                                                    <input type="text" name="mobileNo" value="{{$employee->email ?? ''}}" readonly class="form-control">
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        for="">Mobile No.</label>
                                                                                                    <input type="text" name="mobileNo" value="{{$employee->mobile_no ?? ''}}" class="form-control">
                                                                                                    @error('mobileNo')
                                                                                                    <i class="text-danger">{{$message}}</i>
                                                                                                    @enderror
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        for="">Gender</label>
                                                                                                    <select name="gender" id="gender"
                                                                                                            class="form-control" disabled>
                                                                                                        <option value="1" {{$employee->gender == 1 ? 'selected' : ''}}>Male</option>
                                                                                                        <option value="2" {{$employee->gender == 2 ? 'selected' : ''}}>Female</option>
                                                                                                    </select>
                                                                                                    @error('gender')
                                                                                                    <i class="text-danger">{{$message}}</i>
                                                                                                    @enderror
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        for="">Hire Date</label>
                                                                                                    <input type="text" value="{{date('d M, Y', strtotime($employee->hire_date))}}"
                                                                                                           class="form-control" readonly>
                                                                                                </div>
                                                                                            </td>

                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        for="">Marital Status</label>
                                                                                                    <input type="text" value="{{$employee->employeeMaritalStatus->name ?? ''}}"
                                                                                                           class="form-control" readonly>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                               <div class="form-group">
                                                                                                   <label
                                                                                                       for="">Job Role</label>
                                                                                                   <select name="jobRole" id="jobRole"
                                                                                                           class="form-control" disabled>
                                                                                                       @foreach($jobRoles as $jRole)
                                                                                                           <option value="{{$jRole->id}}" {{$jRole->id == $employee->employeeJobRole->id ? 'selected' : ''}}>{{$jRole->job_role ?? '' }}</option>
                                                                                                       @endforeach
                                                                                                   </select>
                                                                                                   @error('jobRole')
                                                                                                   <i class="text-danger">{{$message}}</i>
                                                                                                   @enderror
                                                                                               </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        for="">Address</label>
                                                                                                    <textarea readonly name="address" placeholder="Type address here..." style="resize: none;"
                                                                                                              class="form-control">{{$employee->address ?? ''}}</textarea>
                                                                                                    @error('address')
                                                                                                    <i class="text-danger">{{$message}}</i>
                                                                                                    @enderror
                                                                                                    <input type="hidden" name="empId" value="{{$employee->id}}">
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        for="">State</label>
                                                                                                    <select name="state" id="state"
                                                                                                            class="form-control" disabled>
                                                                                                        @foreach($states as $state )
                                                                                                            <option value="{{$state->id}}" {{$state->id == $employee->getEmployeeState->id ? 'selected' : '' }}>{{$state->state_name ?? '' }}</option>
                                                                                                        @endforeach
                                                                                                    </select>
                                                                                                    @error('state')
                                                                                                    <i class="text-danger">{{$message}}</i>
                                                                                                    @enderror
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        for="">Department</label>
                                                                                                    <select name="department" id="department"
                                                                                                            class="form-control" disabled>
                                                                                                        @foreach($departments as $department )
                                                                                                            <option value="{{$department->id}}" {{$department->id == $employee->employeeDepartment->id ? 'selected' : '' }}>{{$department->name ?? '' }}</option>
                                                                                                        @endforeach
                                                                                                    </select>
                                                                                                    @error('department')
                                                                                                    <i class="text-danger">{{$message}}</i>
                                                                                                    @enderror
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        for="">Academic Qualification</label>
                                                                                                    <select name="qualification" id="qualification"
                                                                                                            class="form-control" disabled>
                                                                                                        @foreach($qualifications as $qualification )
                                                                                                            <option value="{{$qualification->id}}" {{$qualification->id == $employee->employeeAcademicQualification->id ? 'selected' : '' }}>{{$qualification->name ?? '' }}</option>
                                                                                                        @endforeach
                                                                                                    </select>
                                                                                                    @error('qualification')
                                                                                                    <i class="text-danger">{{$message}}</i>
                                                                                                    @enderror
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        for="">Employment Type</label>
                                                                                                    <select name="employmentType" id="employmentType"
                                                                                                            class="form-control" disabled>
                                                                                                        @foreach($employement_types as $type )
                                                                                                            <option value="{{$type->id}}" {{$type->id == $employee->employeeEmploymentType->id ? 'selected' : '' }}>{{$type->name ?? '' }}</option>
                                                                                                        @endforeach
                                                                                                    </select>
                                                                                                    @error('employmentType')
                                                                                                    <i class="text-danger">{{$message}}</i>
                                                                                                    @enderror
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        for="">Employee ID</label>
                                                                                                    <input type="text" readonly value="{{$employee->employee_id ?? ''}}" name="employeeId" placeholder="Employee ID" class="form-control">
                                                                                                    @error('employeeId')
                                                                                                    <i class="text-danger">{{$message}}</i>
                                                                                                    @enderror
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        for="">Blood Group</label>
                                                                                                    <input readonly type="text" value="{{$employee->getBloodGroup->name ?? ''}}" name="bloodGroup" placeholder="Blood Group" class="form-control">
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        for="">Known Ailment</label>
                                                                                                    <input readonly type="text" value="{{$employee->known_ailment ?? ''}}" name="knownAilment" placeholder="Known Ailment" class="form-control">
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>

                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-12 d-flex justify-content-center ">
                                                                                <button class="btn btn-primary btn-sm" type="submit" disabled>Save Changes</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="profile3" role="tabpanel">
                                            <div class="row mt-3">
                                               <div class="col-md-6 offset-md-3 col-lg-6 offset-lg-3">
                                                   <div class="container pb-5">
                                                       <form action="{{route('change-password')}}" method="post" enctype="multipart/form-data">
                                                           @csrf
                                                           <div class="form-group">
                                                               <label for="">Current Password <span class="text-danger">*</span></label>
                                                               <input type="password"  name="currentPassword" placeholder="Current Password"  class="form-control">
                                                               @error('currentPassword') <i class="text-danger">{{$message}}</i>@enderror
                                                           </div>
                                                           <div class="form-group mt-3">
                                                               <label for="">New Password <span class="text-danger">*</span></label>
                                                               <input type="password" name="password" placeholder="New Password" class="form-control">
                                                               @error('password') <i class="text-danger">{{$message}}</i>@enderror
                                                           </div>
                                                           <div class="form-group mt-3">
                                                               <label for="">Re-type Password <span class="text-danger">*</span></label>
                                                               <input type="password" name="password_confirmation" placeholder="Re-type Password" class="form-control">
                                                               @error('password_confirmation') <i class="text-danger">{{$message}}</i>@enderror
                                                           </div>
                                                           <div class="form-group mt-3 d-flex justify-content-center">
                                                               <button type="submit" class="btn btn-primary">Change Password <i class="bx bx-lock-alt"></i> </button>
                                                           </div>
                                                       </form>
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
