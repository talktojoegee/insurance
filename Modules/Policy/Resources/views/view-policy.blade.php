@extends('layouts.master')

@section('title')
    Non-motor Policies
@endsection

@section('extra-styles')

@endsection
@section('main-content')

<div class="container">
    <div class="row">
        <div class="col-xl-12 col-lg-12  filter-bar">
            <nav class="navbar navbar-light bg-faded m-b-30 p-10">
                <div class="nav-item nav-grid">
                    <a href="{{ url('/human-resource/employees') }}" class="btn btn-primary btn-mini waves-effect waves-light"><i class="icofont icofont-car-alt-4 mr-2"></i>Add New Motor Policy</a>
                    <a href="{{ url('/policy/create') }}" class="btn btn-primary btn-mini waves-effect waves-light"><i class="icofont icofont-plane-ticket mr-2"></i>Add New Non-motor Policy</a>
                </div>
            </nav>
        </div>
    </div>
</div>
    <div class="container">
        <div>
            <div class="card">
                <div class="row invoice-contact">
                    <div class="col-md-8">
                        <div class="invoice-box row">
                            <div class="col-sm-12">
                                <table class="table table-responsive invoice-table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td><img src="..\files\assets\images\logo-blue.png" class="m-b-10" alt=""></td>
                                        </tr>
                                        <tr>
                                            <td>Compney Name</td>
                                        </tr>
                                        <tr>
                                            <td>123 6th St. Melbourne, FL 32904 West Chicago, IL 60185</td>
                                        </tr>
                                        <tr>
                                            <td><a href="..\..\..\cdn-cgi\l\email-protection.htm#99fdfcf4f6d9fef4f8f0f5b7faf6f4" target="_top"><span class="__cf_email__" data-cfemail="690d0c0406290e04080005470a0604">[email&#160;protected]</span></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>+91 919-91-91-919</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                    </div>
                </div>
                <div class="view-info">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="general-info">
                                <div class="row">
                                    <div class="col-lg-12 col-xl-4 col-md-4">
                                        <h6 class="text-primary text-uppercase ml-3">Policy Documentation</h6>
                                        <div class="table-responsive">
                                            <table class="table m-0">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">Policy No.</th>
                                                        <td>{{ $policy->policy_number ?? '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Client No.</th>
                                                        <td>{{$policy->getBusinessClass->abbr}}/{{date('m',strtotime($policy->created_at))}}/{{date('y', strtotime($policy->created_at))}}/{{$policy->policy_number}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Insurance Policy No.</th>
                                                        <td>{{ $policy->insurance_policy_number ?? '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Business Class</th>
                                                        <td>{{ $policy->getBusinessClass->class_name ?? '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Sub-business Class</th>
                                                        <td>{{ $policy->getSubBusinessClass->class_name ?? '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Start Date</th>
                                                        <td>{{ !is_null($policy->start_date) ? date('d F, Y', strtotime($policy->start_date)) : '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">End Date</th>
                                                        <td>{{ !is_null($policy->end_date) ? date('d F, Y', strtotime($policy->end_date)) : '' }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-xl-4 col-md-4">
                                        <h6 class="text-primary text-uppercase ml-3">Client Information</h6>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">Insured Name</th>
                                                        <td>
                                                            {{$policy->getClient->insured_name ?? ''}}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Email</th>
                                                        <td>{{$policy->getClient->email ?? ''}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Mobile No.</th>
                                                        <td>{{$policy->getClient->mobile_no ?? ''}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Address</th>
                                                        <td>{{$policy->getClient->address ?? ''}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-xl-4 col-md-4">
                                        <h6 class="text-primary text-uppercase ml-3">Payment Information</h6>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">Sum Insured</th>
                                                        <td>{{ number_format($policy->sum_insured,2) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Premium Rate</th>
                                                        <td>{{ $policy->premium_rate }}%</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Gross Premium</th>
                                                        <td>{{ number_format($policy->gross_premium,2) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Exchange Rate</th>
                                                        <td>{{ $policy->exchange_rate ?? '-' }}</td>
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
            <div class="row text-center">
                <div class="col-sm-12 filter-bar invoice-btn-group text-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger waves-effect m-b-10 btn-mini waves-light"><i class="icofont icofont-ui-block mr-2"></i> Cancel</button>
                        <button type="button" class="btn btn-primary btn-print-invoice m-b-10 btn-mini waves-effect waves-light m-r-20"><i class="ti-printer mr-2"></i>Print</button>
                        <button type="button" class="btn btn-warning btn-print-invoice m-b-10 btn-mini waves-effect waves-light m-r-20"><i class="ti-pencil mr-2"></i>Edit</button>
                        <button type="button" class="btn btn-danger btn-print-invoice m-b-10 btn-mini waves-effect waves-light m-r-20"><i class="ti-trash mr-2"></i>Delete</button>
                        <a href="{{ url('/policy/debit-note/new/'.$policy->slug) }}" class="btn btn-success btn-print-invoice m-b-10 btn-mini waves-effect waves-light m-r-20"><i class="ti-check mr-2"></i>Raise Debit Note</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')

@endsection
