@extends('layouts.master')

@section('title')
    Human Resource
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
<div class="row users-card">
    @foreach($employees as $employee)
            <div class="col-lg-6 col-xl-3 col-md-6">
                <div class="card rounded-card user-card">
                    <div class="card-block">
                        <div class="img-hover">
                            <img class="img-fluid img-radius" src="\assets\images\user-card\img-round1.jpg" alt="round-img">
                            <div class="img-overlay img-radius">
                                <span>
                                    <a href="#" class="btn btn-sm btn-primary" data-popup="lightbox"><i class="icofont icofont-plus"></i></a>
                                    <a href="{{url('/human-resource/employee/profile/'.$employee->url)}}" class="btn btn-sm btn-primary"><i class="icofont icofont-link-alt"></i></a>
                                </span>
                            </div>
                        </div>
                        <div class="user-content">
                            <h4 class="">{{ $employee->first_name ?? '' }} {{ $employee->surname ?? '' }}</h4>
                            <p class="m-b-0 text-muted">{{ $employee->employeeDepartment->name ?? '' }}</p>
                            <p class="m-b-0 text-muted">{{ $employee->employeeJobRole->job_role ?? '' }}</p>
                        </div>

                    </div>
                </div>
            </div>
    @endforeach
</div>
@endsection
