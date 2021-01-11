@extends('layouts.master')

@section('title')
    Motor Policies
@endsection

@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\css\toastify.min.css">
    <link rel="stylesheet" type="text/css" href="\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
@endsection
@section('main-content')


<div class="row">
   <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
            <div class="card-block-small">
                <i class="feather icon-pie-chart bg-c-blue card1-icon"></i>
                <span class="text-c-blue f-w-600">Use Space</span>
                <h4>49/50GB</h4>
                <div>
                    <span class="f-left m-t-10 text-muted">
                        <i class="text-c-blue f-16 feather icon-alert-triangle m-r-10"></i>Get more space
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
            <div class="card-block-small">
                <i class="feather icon-home bg-c-pink card1-icon"></i>
                <span class="text-c-pink f-w-600">Revenue</span>
                <h4>$23,589</h4>
                <div>
                    <span class="f-left m-t-10 text-muted">
                        <i class="text-c-pink f-16 feather icon-calendar m-r-10"></i>Last 24 hours
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
            <div class="card-block-small">
                <i class="feather icon-alert-triangle bg-c-green card1-icon"></i>
                <span class="text-c-green f-w-600">Fixed Issue</span>
                <h4>45</h4>
                <div>
                    <span class="f-left m-t-10 text-muted">
                        <i class="text-c-green f-16 feather icon-tag m-r-10"></i>Tracked at microsoft
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
            <div class="card-block-small">
                <i class="feather icon-twitter bg-c-yellow card1-icon"></i>
                <span class="text-c-yellow f-w-600">Followers</span>
                <h4>+562</h4>
                <div>
                    <span class="f-left m-t-10 text-muted">
                        <i class="text-c-yellow f-16 feather icon-watch m-r-10"></i>Just update
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12  filter-bar">
        <nav class="navbar navbar-light bg-faded m-b-30 p-10">
            <div class="nav-item nav-grid">
                <a href="{{ url('/policy/create-motor-policy')}}" class="btn btn-primary btn-mini waves-effect waves-light"><i class="icofont icofont-car-alt-4 mr-2"></i>Add New Motor Policy</a>
                <a href="{{ url('/policy/create') }}" class="btn btn-primary btn-mini waves-effect waves-light"><i class="icofont icofont-plane-ticket mr-2"></i>Add New Non-motor Policy</a>
            </div>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-block">
                <h5 class="sub-title">Motor Policies</h5>
                @if(session()->has('success'))
                    <div class="alert alert-success background-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="icofont icofont-close-line-circled text-white"></i>
                        </button>
                        {!!  session()->get('success') !!}
                    </div>
                @endif
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
                                <th>Client No.</th>
                                <th>Insured</th>
                                <th>Insurance Policy No.</th>
                                <th>Email</th>
                                <th>Mobile No.</th>
                                <th>Birth Date</th>
                                <th>Sum Insured</th>
                                <th>Premium Rate</th>
                                <th>Exchange Rate</th>
                                <th>Gross Premium</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Business Class</th>
                                <th>Sub Class</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $serial = 1;
                            @endphp
                           @foreach($policies as $policy)
                                <tr>
                                    <td>{{ $serial++ }}</td>
                                    <td>{{$policy->getBusinessClass->abbr}}/{{date('m',strtotime($policy->created_at))}}/{{date('y', strtotime($policy->created_at))}}/{{$policy->policy_number}}</td>
                                    <td> <a href="{{ url('/client/view/'.$policy->getClient->slug) }}"> {{ $policy->getClient->insured_name ?? '' }}</a></td>
                                    <td>{{ $policy->insurance_policy_number ?? '' }}</td>
                                    <td>{{ $policy->getClient->email ?? '' }}</td>
                                    <td>{{ $policy->getClient->mobile_no ?? '' }}</td>
                                    <td>{{ !is_null($policy->getClient->birth_date) ? date('d F, Y', strtotime($policy->getClient->birth_date)) : '' }}</td>
                                    <td>{{$policy->getCurrency->symbol ?? ''}}{{ number_format($policy->sum_insured/$policy->exchange_rate,2) }}</td>
                                    <td>{{ $policy->premium_rate ?? '' }}%</td>
                                    <td>{{ $policy->exchange_rate  ?? '' }}</td>
                                    <td>{{$policy->getCurrency->symbol ?? ''}}{{ number_format($policy->gross_premium/$policy->exchange_rate,2) ?? '' }}</td>
                                    <td>{{ !is_null($policy->start_date) ? date('d F, Y', strtotime($policy->start_date)) : '' }}</td>
                                    <td>{{ !is_null($policy->end_date) ? date('d F, Y', strtotime($policy->end_date)) : '' }}</td>
                                    <td>{{ $policy->getBusinessClass->class_name ?? '' }}</td>
                                    <td>{{ $policy->getSubBusinessClass->class_name ?? '' }}</td>
                                    <td>
                                        <a href="{{ url('/policy/view/policy/'.$policy->slug) }}">Learn more</a>
                                    </td>
                                </tr>
                           @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Client No.</th>
                                <th>Insured</th>
                                <th>Insurance Policy No.</th>
                                <th>Email</th>
                                <th>Mobile No.</th>
                                <th>Birth Date</th>
                                <th>Sum Insured</th>
                                <th>Premium Rate</th>
                                <th>Exchange Rate</th>
                                <th>Gross Premium</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Business Class</th>
                                <th>Sub Class</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
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
