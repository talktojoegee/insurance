@extends('layouts.master')

@section('title')
    Add New Employee
@endsection

@section('current-page')
    Add New Employee
@endsection
@section('current-page-brief')
Add New Employee
@endsection
@section('main-content')
<div class="row">
    <div class="col-xl-12 col-lg-12  filter-bar">
        <nav class="navbar navbar-light bg-faded m-b-30 p-10">
            <div class="nav-item nav-grid">
                <a href="{{ url('/human-resource/employees') }}" class="btn btn-primary btn-mini waves-effect waves-light"><i class="icofont icofont-users-alt-3 mr-2"></i>Manage Employees</a>
            </div>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-block">
                <h5 class="sub-title">Add New Employee</h5>
                <h5 class="mb-3">Personal Information</h5>
                <form action="{{url('/human-resource/add-new-employee')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12">
                            <div class="form-group">
                                <label>First Name</label>
                                <input class="form-control" value="{{ old('first_name') }}" placeholder="First Name" name="first_name" id="first_name">
                                @error('first_name')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input class="form-control" value="{{ old('last_name') }}" placeholder="Last Name" name="last_name" id="last_name">
                                @error('last_name')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12">
                            <div class="form-group">
                                <label>Other Names</label>
                                <input class="form-control" value="{{ old('other_names') }}" placeholder="Other Names" name="other_names" id="other_names">
                                @error('other_names')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input class="form-control" value="{{ old('email_address') }}" placeholder="Email Address" name="email_address" id="email_address">
                                @error('email_address')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12">
                            <div class="form-group">
                                <label>Mobile No.</label>
                                <input class="form-control" value="{{ old('mobile_no') }}" placeholder="Mobile No." name="mobile_no" id="mobile_no">
                                @error('mobile_no')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-3 col-sm-4">
                            <div class="form-group">
                                <label>Gender</label>
                                <select class="form-control" value="{{ old('gender') }}" name="gender" id="gender">
                                    <option selected disabled >Select gender</option>
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                </select>
                                @error('gender')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-3 col-sm-4">
                            <div class="form-group">
                                <label>Marital Status</label>
                                <select class="form-control" value="{{ old('marital_status') }}" name="marital_status" id="marital_status">
                                    <option selected disabled >Select Marital Status</option>
                                    @foreach($marital_status as $status)
                                        <option value="{{$status->id}}">{{$status->name ?? ''}}</option>
                                    @endforeach
                                </select>
                                @error('marital_status')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-lg-3 col-xl-3 col-sm-6">
                            <div class="form-group">
                                <label>State of Origin</label>
                                <select class="form-control" value="{{ old('state_of_origin') }}" name="state_of_origin" id="state_of_origin">
                                    <option selected disabled >Select state</option>
                                    @foreach($states as $state)
                                    <option value="{{$state->id}}"> {{$state->state_name ?? '' }}</option>
                                    @endforeach
                                </select>
                                @error('state_of_origin')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-3 col-sm-6" id="lgaWrapper">

                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-3 col-sm-4">
                            <div class="form-group">
                                <label>Blood Group</label>
                                <select class="form-control" value="{{ old('blood_group') }}" name="blood_group" id="blood_group">
                                    <option selected disabled >Select blood group</option>
                                    @foreach($blood_groups as $group)
                                    <option value="{{$group->id}}">{{$group->name ?? ''}}</option>
                                    @endforeach
                                </select>
                                @error('blood_group')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 col-sm-6 col-lg-6">
                            <label>Birth Date</label>
                            <input type="date" class="form-control" value="{{ old('birth_date') }}" name="birth_date" placeholder="Birth Date" id="birth_date">
                            @error('birth_date')
                                <i class="text-danger mt-2">{{ $message }}</i>
                            @enderror
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6">
                            <label>Known Ailment</label>
                            <input type="text" class="form-control" value="{{ old('known_ailment') }}" name="known_ailment" placeholder="Known Ailment" id="known_ailment">
                            @error('known_ailment')
                                <i class="text-danger mt-2">{{ $message }}</i>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label>Residential Address</label>
                                <textarea placeholder="Residential Address" name="residential_address" id="residential_address" class="form-control" style="resize: none;">{{ old('residential_address') }}</textarea>
                                @error('residential_address')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <h5 class="mb-3">Work Information</h5>
                    <div class="row">
                        <div class="col-md-3 col-lg-3 col-xl-3 col-sm-6">
                            <div class="form-group">
                                <label>Department</label>
                                <select class="form-control" name="department" value="{{ old('department') }}" id="department">
                                    <option selected disabled >Select department</option>
                                    @foreach($departments as $department)
                                        <option value="{{$department->id}}">{{$department->name ?? ''}}</option>
                                    @endforeach
                                </select>
                                @error('department')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-3 col-sm-6">
                            <div class="form-group">
                                <label>Job Role</label>
                                <select class="form-control" value="{{ old('job_role') }}" name="job_role" id="job_role">
                                    <option selected disabled >Select Job Role</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->job_role ?? ''}}</option>
                                    @endforeach
                                </select>
                                @error('job_role')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-3 col-sm-6">
                            <div class="form-group">
                                <label>Academic Qualification</label>
                                <select class="form-control" value="{{ old('academic_qualification') }}" name="academic_qualification" id="academic_qualification">
                                    <option selected disabled >Select academic qualification</option>
                                    @foreach($qualifications as $qualification)
                                        <option value="{{$qualification->id}}">{{$qualification->name ?? ''}}</option>
                                    @endforeach
                                </select>
                                @error('academic_qualification')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-3 col-sm-6">
                            <div class="form-group">
                                <label>Employment Type</label>
                                <select class="form-control" value="{{ old('employment_type') }}" name="employment_type" id="employment_type">
                                    <option selected disabled >Select employment type</option>
                                    @foreach($emp_types as $type)
                                        <option value="{{$type->id}}">{{$type->name ?? ''}}</option>
                                    @endforeach
                                </select>
                                @error('employment_type')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-lg-3 col-xl-3 col-sm-6">
                            <div class="form-group">
                                <label>Hire Date</label>
                                   <input type="date" value="{{ old('hire_date') }}" class="form-control" name="hire_date" id="hire_date">
                                @error('hire_date')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-3 col-sm-6">
                            <div class="form-group">
                                <label>Employee ID</label>
                                   <input type="text" placeholder="Employee ID" value="{{ old('employee_id') }}" class="form-control" name="employee_id" id="employee_id">
                                @error('employee_id')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-3 col-sm-6">
                            <div class="form-group">
                                <label>Application Access Level</label>
                                 <select class="form-control" id="application_access_level" name="application_access_level">
                                    <option selected disabled>Select access level</option>
                                    @foreach ($access as $item)
                                        <option value="{{$item->id}}">{{$item->name ?? ''}}</option>
                                    @endforeach
                                </select>
                                @error('application_access_level')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12 d-flex justify-content-center">
                            <div class="btn-group">
                                <a class="btn btn-danger btn-mini" href=""><i class="ti-close mr-2"></i> Cancel</a>
                                <button type="submit" class="btn btn-primary btn-mini"><i class="ti-check mr-2"></i> Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
    <script src="/assets/js/axios.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#state_of_origin').on('change', function(e){
                e.preventDefault();
                axios.post('/load-local-governments', {state:$(this).val()})
                    .then(response=>{
                        $('#lgaWrapper').html(response.data);
                    });
            });
        });
    </script>
@endsection
