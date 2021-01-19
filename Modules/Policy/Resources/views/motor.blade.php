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
    <div class="col-md-6 col-xl-4">
         <div class="card widget-card-1">
             <div class="card-block-small">
                 <i class="feather icon-pie-chart bg-c-blue card1-icon"></i>
                 <span class="text-c-blue f-w-600">Total</span>
                 <h4>{{number_format($policies->count())}}</h4>
                 <div>
                     <span class="f-left m-t-10 text-muted">
                         <i class="text-c-blue f-16 feather icon-alert-triangle m-r-10"></i>Motor Policies
                     </span>
                 </div>
             </div>
         </div>
     </div>
     <div class="col-md-6 col-xl-4">
         <div class="card widget-card-1">
             <div class="card-block-small">
                 <i class="feather icon-home bg-c-pink card1-icon"></i>
                 <span class="text-c-pink f-w-600">Total</span>
                 <h4>{{number_format($policies->sum('sum_insured'),2)}}</h4>
                 <div>
                     <span class="f-left m-t-10 text-muted">
                         <i class="text-c-pink f-16 feather icon-calendar m-r-10"></i>Sum Insured
                     </span>
                 </div>
             </div>
         </div>
     </div>
     <div class="col-md-6 col-xl-4">
         <div class="card widget-card-1">
             <div class="card-block-small">
                 <i class="ti-wallet bg-c-green card1-icon"></i>
                 <span class="text-c-green f-w-600">Total</span>
                 <h4>{{number_format($policies->sum('gross_premium'))}}</h4>
                 <div>
                     <span class="f-left m-t-10 text-muted">
                         <i class="text-c-green f-16 feather icon-tag m-r-10"></i>Gross Premium
                     </span>
                 </div>
             </div>
         </div>
     </div>
 </div>
@include('policy::partials._policy-shortcut')
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

                                    <td>{{$policy->getCurrency->symbol ?? ''}}{{ number_format($policy->sum_insured/$policy->exchange_rate,2) }}</td>
                                    <td>{{ $policy->premium_rate ?? '' }}%</td>
                                    <td>{{ $policy->exchange_rate  ?? '' }}</td>
                                    <td>{{$policy->getCurrency->symbol ?? ''}}{{ number_format($policy->gross_premium/$policy->exchange_rate,2) ?? '' }}</td>
                                    <td>{{ !is_null($policy->start_date) ? date('d F, Y', strtotime($policy->start_date)) : '' }}</td>
                                    <td>{{ !is_null($policy->end_date) ? date('d F, Y', strtotime($policy->end_date)) : '' }}</td>
                                    <td>{{ $policy->getBusinessClass->class_name ?? '' }}</td>
                                    <td>{{ $policy->getSubBusinessClass->class_name ?? '' }}</td>
                                    <td>
                                        <a href="{{ url('/policy/view/policy/'.$policy->slug) }}" class="btn btn-mini btn-primary">Learn more</a>
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
