@extends('layouts.master')

@section('title')
    All Employees
@endsection
@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\css\toastify.min.css">
    <link rel="stylesheet" type="text/css" href="\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
@endsection
@section('current-page')
    All Employees
@endsection
@section('current-page-brief')
Company's workforce.
@endsection
@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    <div class="row">

                        <div class="col-sm-6">
                            <h2 class="d-inline-block text-c-green m-r-10">{{number_format($employees->where('account_status',1)->count())}}</h2>
                            <div class="d-inline-block">
                                <p class="m-b-0"><i class="ti-check m-r-10 text-c-green"></i></p>
                                <p class="text-muted m-b-0"> Active Employees</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <h2 class="d-inline-block text-c-pink m-r-10">{{number_format($employees->where('account_status',2)->count())}}</h2>
                            <div class="d-inline-block">
                                <p class="m-b-0"><i class="ti-stamp m-r-10 text-c-pink"></i></p>
                                <p class="text-muted m-b-0">Deactivated Employees</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
<div class="row">
    <div class="col-md-12">
        @if(session()->has('error'))
            <div class="alert alert-warning background-warning">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="icofont icofont-close-line-circled text-white"></i>
                </button>
                {!!  session()->get('error') !!}
            </div>
        @endif
        <div class="dt-responsive table-responsive">
            <table id="businessTable" class="portableTables table table-striped table-bordered nowrap">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Mobile No.</th>
                    <th>Department</th>
                    <th>Employee ID</th>
                    <th>Gender</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $serial = 1;
                @endphp
                @foreach($employees as $employee)
                    <tr>
                        <td>{{$serial++}}</td>
                        <td>{{$employee->first_name ?? ''}} {{$employee->last_name ?? '' }}</td>
                        <td>{{$employee->email ?? ''}}</td>
                        <td>{{$employee->mobile_no ?? ''}}</td>
                        <td>{{$employee->employeeDepartment->name ?? ''}}</td>
                        <td>{{$employee->employee_id ?? ''}}</td>
                        <td>{{$employee->gender == 1 ? 'Male' : 'Female' }}</td>
                        <td>
                            {!! $employee->account_status == 1 ? "<span class='badge badge-success'>Active</span>" : "<span class='badge badge-danger'>Deactivated</span>" !!}
                        </td>
                        <td>
                            <a href="{{url('/human-resource/employee/profile/'.$employee->url)}} " class="btn btn-mini btn-primary">Learn more</a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Mobile No.</th>
                    <th>Employee ID</th>
                    <th>Gender</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

@endsection
@section('extra-scripts')

    <script src="\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>

    <script src="\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
    <script src="\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
    <script src="\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>

    <script src="\assets\pages\data-table\js\data-table-custom.js"></script>

@endsection
