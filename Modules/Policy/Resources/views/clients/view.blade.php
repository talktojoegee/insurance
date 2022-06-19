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
    @include('policy::partials._client-shortcut')
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
                                            <a class="nav-link" data-toggle="tab" href="#settings1" role="tab">Claims</a>
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
                                            <h5 class="sub-title text-primary">Credit Notes</h5>
                                            <div class="table-responsive">
                                                <table id="creditNotesTable" class="display table-bordered" style="width:100%">
                                                    <thead>
                                                    <tr class="text-uppercase">
                                                        <th>#</th>
                                                        <th>Credit Code</th>
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
                                                    @foreach ($client->getClientCreditNotes as $lst)
                                                        <tr>
                                                            <td>{{$d++}}</td>
                                                            <td>{{$lst->credit_code}}</td>
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
                                                            <td>{{!is_null($lst->end_date) ? date('d M, Y', strtotime($lst->end_date)) : 'Unknown'}}</td>
                                                            <td>
                                                                <a href="/policy/credit-note/view/{{$lst->slug}}">Learn more</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                    <tr class="text-uppercase">
                                                        <th>#</th>
                                                        <th>Credit Code</th>
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
                                        <div class="tab-pane" id="settings1" role="tabpanel">
                                            <h5 class="sub-title text-primary"> Claims</h5>
                                            <div class="table-responsive">
                                                <table id="claimsTable" class="portableTables table table-striped table-bordered nowrap">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Claim No.</th>
                                                        <th>Insured Name</th>
                                                        <th>Notif. Date</th>
                                                        <th>Date Loss</th>
                                                        <th>Est. Amount</th>
                                                        <th>Status</th>
                                                        <th>Business Class</th>
                                                        <th>Sub-business Class</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php
                                                        $index = 1;
                                                    @endphp
                                                    @foreach ($client->getClientClaims as $item)
                                                        <tr>
                                                            <td>{{$index++}}</td>
                                                            <td>{{$item->claim_no ?? ''}}</td>
                                                            <td>{{$item->getClient->insured_name ?? ''}}</td>
                                                            <td>{{!is_null($item->notification_date) ? date('d M, Y', strtotime($item->notification_date)) : '-'}}</td>
                                                            <td>{{!is_null($item->loss_date) ? date('d M, Y', strtotime($item->loss_date)) : '-'}}</td>
                                                            <td>{{$item->getCurrency->symbol ?? 'N'}}{{number_format($item->estimated_claim_amount, 2)}}</td>
                                                            <td>
                                                                @if ($item->status == 0)
                                                                    <label for="" class="label label-warning">Pending</label>
                                                                @elseif($item->status == 1)
                                                                    <label for="" class="label label-success">Approved</label>
                                                                @elseif($item->status == 2)
                                                                    <label for="" class="label label-danger">Declined</label>
                                                                @endif
                                                            </td>
                                                            <td>{{$item->getBusinessClass->class_name ?? ''}}</td>
                                                            <td>{{$item->getSubBusinessClass->class_name ?? ''}}</td>
                                                            <td>
                                                                <a href="/policy/claim/view/{{$item->slug}}" class="btn btn-primary btn-mini">Learn more</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Claim No.</th>
                                                        <th>Insured Name</th>
                                                        <th>Notif. Date</th>
                                                        <th>Date Loss</th>
                                                        <th>Est. Amount</th>
                                                        <th>Status</th>
                                                        <th>Business Class</th>
                                                        <th>Sub-business Class</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-block">
                                    <div class="col-lg-12 col-xl-12">
                                        <div class="sub-title">Log</div>
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs md-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#home3" role="tab">Conversation</a>
                                                <div class="slide"></div>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#profile3" role="tab">Employee Assignment</a>
                                                <div class="slide"></div>
                                            </li>
                                        </ul>
                                        <!-- Tab panes -->
                                        <div class="tab-content card-block">
                                            <div class="tab-pane active" id="home3" role="tabpanel">
                                                <p class="m-0">1. This is Photoshop's version of Lorem IpThis is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean mas Cum sociis natoque penatibus et magnis dis.....</p>
                                            </div>
                                            <div class="tab-pane" id="profile3" role="tabpanel">
                                                <p class="m-0">2.Cras consequat in enim ut efficitur. Nulla posuere elit quis auctor interdum praesent sit amet nulla vel enim amet. Donec convallis tellus neque, et imperdiet felis amet.</p>
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

    <div class="modal fade" id="sendSms" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title">Send SMS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="form-group">
                            <label for="">To:</label>
                            <input readonly type="text" value="{{$client->mobile_no ?? '+234'}}" placeholder="Enter Mobile No." name="mobile_no" class="form-control">
                            @error('mobile_no')
                            <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Compose SMS:</label>
                            <textarea name="message" rows="5" style="resize: none;" placeholder="Compose SMS here..." class="form-control">{{old('message')}}</textarea>
                            @error('message')
                            <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="form-group d-flex justify-content-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm  btn-default waves-effect " data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-sm btn-primary waves-effect waves-light ">Send SMS</button>
                            </div>
                        </div>
                    </form>
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
        $('#creditNotesTable').DataTable();
        $('#claimsTable').DataTable();
    });
</script>
@endsection
