@extends('layouts.master')

@section('title')
    Client > {{$client->insured_name}}
@endsection

@section('extra-styles')
<link rel="stylesheet" href="/assets/css/datatables.min.css">
@endsection

@section('current-page')
    Client Details
@endsection
@section('current-page-brief')
    Details of various transactions performed with <strong>{{$client->insured_name ?? ''}}</strong>
@endsection
@section('main-content')
    @include('policy::partials._policy-shortcut')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-block">
                    <h5 class="sub-title text-primary">{{$client->insured_name ?? ''}}</h5>
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
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                            <div class="card">
                                <div class="card-block">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">
                                                        <strong class="text-uppercase">Insured Name:</strong>
                                                    </th>
                                                    <td>{{$client->insured_name ?? ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        <strong class="text-uppercase">Email:</strong>
                                                    </th>
                                                    <td>{{$client->email ?? ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        <strong class="text-uppercase">Mobile No.:</strong>
                                                    </th>
                                                    <td>{{$client->mobile_no ?? ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        <strong class="text-uppercase">Address:</strong>
                                                    </th>
                                                    <td>{{$client->address ?? ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        <strong class="text-uppercase">Member Since:</strong>
                                                    </th>
                                                    <td>{{date('d M, Y', strtotime($client->created_at)) ?? ''}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-8 col-lg-8 col-xl-8">
                            <div class="card">
                                <div class="card-block">
                                    <ul class="nav nav-tabs  tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#home1" role="tab">Policies</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#profile1" role="tab">Debit Notes</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#messages1" role="tab">Credit Notes</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#settings1" role="tab">Invoices</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content tabs card-block">
                                        <div class="tab-pane active" id="home1" role="tabpanel">
                                            <h5 class="sub-title text-primary"> Policies</h5>
                                            <div class="table-responsive">
                                                <table id="clientPoliciesTable" class="display table-bordered" style="width:100%">
                                                    <thead>
                                                        <tr class="text-uppercase">
                                                            <th>#</th>
                                                            <th>Client No.</th>
                                                            <th>In. Policy No.</th>
                                                            <th>Sum Insured</th>
                                                            <th>End Date</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $serial = 1;
                                                        @endphp
                                                        @foreach ($client->getClientPolicies as $policy)
                                                            <tr>
                                                                <td>{{$serial++}}</td>
                                                                <td>{{$policy->getBusinessClass->abbr}}/{{date('m',strtotime($policy->created_at))}}/{{date('y', strtotime($policy->created_at))}}/{{$policy->policy_number}}</td>
                                                                <td>{{ $policy->insurance_policy_number ?? '' }}</td>
                                                                <td>{{$policy->getCurrency->symbol ?? ''}}{{ number_format($policy->sum_insured/$policy->exchange_rate,2) }}</td>
                                                                <td>{{ !is_null($policy->end_date) ? date('d F, Y', strtotime($policy->end_date)) : '' }}</td>
                                                                <td>
                                                                    <a href="{{ url('/policy/view/policy/'.$policy->slug) }}">Learn more</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr class="text-uppercase">
                                                            <th>#</th>
                                                            <th>Client No.</th>
                                                            <th>In. Policy No.</th>
                                                            <th>Sum Insured</th>
                                                            <th>Date</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="profile1" role="tabpanel">
                                            <h5 class="sub-title text-primary">Debit Notes</h5>
                                            <div class="table-responsive">
                                                <table id="clientDebitNoteTable" class="display table-bordered" style="width:100%">
                                                    <thead>
                                                        <tr class="text-uppercase">
                                                            <th>#</th>
                                                            <th>Debit Code</th>
                                                            <th>Client No.</th>
                                                            <th>Option</th>
                                                            <th>Business Type</th>
                                                            <th>End Date</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $d = 1;
                                                        @endphp
                                                        @foreach ($client->getClientDebitNotes as $lst)
                                                            <tr>
                                                                <td>{{$d++}}</td>
                                                                <td>{{$lst->debit_code}}</td>
                                                                <td>{{$lst->getPolicy->getBusinessClass->abbr}}/{{date('m',strtotime($lst->getPolicy->getBusinessClass->created_at))}}/{{date('y',strtotime($lst->getPolicy->getBusinessClass->created_at))}}/{{$lst->getPolicy->policy_number}}</td>

                                                                    @if($lst->option == 1)
                                                                        <td>Direct</td>
                                                                    @elseif($lst->option == 2)
                                                                        <td>Co-broking</td>
                                                                    @elseif($lst->option == 3)
                                                                        <td>Lead-broking</td>
                                                                    @elseif($lst->option == 4)
                                                                        <td>Outward Reinsurance</td>
                                                                    @elseif($lst->option == 5)
                                                                        <td>Inward Reinsurance</td>
                                                                    @endif

                                                                    @if($lst->business_type == 1)
                                                                        <td>New</td>
                                                                    @elseif($lst->business_type == 2)
                                                                        <td>Additional</td>
                                                                    @elseif($lst->business_type == 3)
                                                                        <td>Renewal</td>
                                                                    @elseif($lst->business_type == 4)
                                                                        <td>Return</td>
                                                                    @elseif($lst->business_type == 5)
                                                                        <td>Reversal</td>
                                                                    @endif
                                                                <td>{{date('d M, Y', strtotime($lst->end_date))}}</td>
                                                                <td>
                                                                    <a href="{{ url('/policy/view/policy/'.$policy->slug) }}">Learn more</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr class="text-uppercase">
                                                            <th>#</th>
                                                            <th>Debit Code</th>
                                                            <th>Client No.</th>
                                                            <th>Option</th>
                                                            <th>Business Type</th>
                                                            <th>End Date</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        </div>
                                        <div class="tab-pane" id="messages1" role="tabpanel">
                                            <p class="m-0">3. This is Photoshop's version of Lorem IpThis is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean mas Cum sociis natoque penatibus et magnis dis.....</p>
                                        </div>
                                        <div class="tab-pane" id="settings1" role="tabpanel">
                                            <p class="m-0">4.Cras consequat in enim ut efficitur. Nulla posuere elit quis auctor interdum praesent sit amet nulla vel enim amet. Donec convallis tellus neque, et imperdiet felis amet.</p>
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

@endsection

@section('extra-scripts')
<script src="/assets/js/datatables.min.js"></script>
<script>
    $(document).ready(function(){
        $('#clientPoliciesTable').DataTable();
        $('#clientDebitNoteTable').DataTable();
    });
</script>
@endsection
