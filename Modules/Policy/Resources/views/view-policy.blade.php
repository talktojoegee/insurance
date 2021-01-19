@extends('layouts.master')

@section('title')
    Policy Documentation Details
@endsection

@section('extra-styles')

@endsection
@section('current-page')
    Policy Documentation Details
@endsection
@section('current-page-brief')
    Details of {{$policy->policy_number}} policy documentation.
@endsection
@section('main-content')
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
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12" id="policyWrapper">
        <div class="card">
            <div class="card-block">
                <table class="table table-responsive invoice-table table-borderless">
                    <tbody>
                        <tr>
                            <td><img src="\assets\images\logo-blue.png" class="m-b-10" alt=""></td>
                        </tr>
                        <tr>
                            <td>Compney Name</td>
                        </tr>
                        <tr>
                            <td>123 6th St. Melbourne, FL 32904 West Chicago, IL 60185</td>
                        </tr>
                        <tr>
                            <td><a href="..\..\..\cdn-cgi\l\email-protection.htm#99fdfcf4f6d9fef4f8f0f5b7faf6f4" target="_top"><span class="__cf_email__" data-cfemail="690d0c0406290e04080005470a0604">[email&nbsp;protected]</span></a>
                            </td>
                        </tr>
                        <tr>
                            <td>+91 919-91-91-919</td>
                        </tr>
                    </tbody>
                </table>
                <div class="view-info" id="debit_note_details"><div class="row">
                    <div class="col-lg-12">
                        <div class="general-info">
                            <div class="row">
                                <div class="col-lg-12 col-xl-12 col-md-12">
                                    <h6 class="text-white text-uppercase ml-3 bg-secondary p-2">Policy Documentation</h6>
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
                                                <tr>
                                                    <th scope="row">Policy Type</th>
                                                    <td>{{ $policy->policy_type == 1 ? 'Non-motor Policy' : 'Motor Policy' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-12 col-md-12">
                                    <h6 class="text-white text-uppercase ml-3 bg-secondary p-2">Client Information</h6>
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
                                <div class="col-lg-12 col-xl-12 col-md-12">
                                    <h6 class="text-white text-uppercase ml-3 bg-secondary p-2">Payment Information</h6>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Sum Insured</th>
                                                    <td>{{$policy->getCurrency->symbol ?? 'N'}}{{ number_format($policy->sum_insured,2) }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Premium Rate</th>
                                                    <td>{{ $policy->premium_rate }}%</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Gross Premium</th>
                                                    <td>{{$policy->getCurrency->symbol ?? 'N'}}{{ number_format($policy->gross_premium,2) }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Exchange Rate</th>
                                                    <td>{{ $policy->exchange_rate ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Agency</th>
                                                    <td>{{ $policy->getAgency->agent_name ?? '-' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @if ($policy->policy_type == 2)
                                    <div class="col-lg-12 col-xl-12 col-md-12">
                                        <h6 class="text-white text-uppercase ml-3 bg-secondary p-2">Vehicle Information</h6>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    @php
                                                        $v=1;
                                                    @endphp
                                                    @foreach ($policy->getVehicles as $item)
                                                        <tr>
                                                            <td colspan="2">
                                                                <label for="" class="badge badge-danger">{{$v++}}</label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Cover Type</th>
                                                            <td>{{$item->cover_type ?? ''}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Make</th>
                                                            <td>{{ $item->vehicle_make ?? ''}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Registration No.</th>
                                                            <td>{{$item->reg_no ?? ''}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Engine No.</th>
                                                            <td>{{ $item->engine_no ?? '-' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Chassis No.</th>
                                                            <td>{{ $item->chassis_no ?? '-' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">State Issued</th>
                                                            <td>{{ $item->state_issued ?? '-' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Vehicle Value</th>
                                                            <td>#{{ number_format($item->vehicle_value,2) ?? '-' }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif
                            </div>
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
            <div class="dropdown-primary dropdown open">
                <button class="btn btn-primary btn-mini dropdown-toggle waves-effect waves-light " type="button" id="dropdown-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti-more-alt  mr-2"></i>More</button>
                <div class="dropdown-menu" aria-labelledby="dropdown-2" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -172px, 0px); top: 0px; left: 0px; will-change: transform;">
                    <a class="dropdown-item waves-light waves-effect" href="javascript:void(0);" id="printPolicy">Print Policy</a>
                    <a class="dropdown-item waves-light waves-effect" href="#">Email Policy</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item waves-light waves-effect" href="#">Discard Policy</a>
                    <a class="dropdown-item waves-light waves-effect" href="#">Edit Policy</a>
                </div>
            </div>
            <a href="{{ url('/policy/debit-note/new/'.$policy->slug) }}" class="btn btn-success btn-print-invoice m-b-10 btn-mini waves-effect waves-light m-r-20"><i class="ti-check mr-2"></i>Raise Debit Note</a>

        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
<script src="/assets/js/printThis.js"></script>
<script>
    $(document).ready(function(){
        //print without commission
        $(document).on('click', '#printPolicy', function(event){
            $('#policyWrapper').printThis();
        });
    });
</script>
@endsection
