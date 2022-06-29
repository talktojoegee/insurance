@extends('layouts.master')

@section('title')
    Claim Details
@endsection

@section('extra-styles')

@endsection
@section('current-page')
Claim Details
@endsection
@section('current-page-brief')
    Claim details
@endsection
@section('main-content')

    @include('policy::partials._claim-shortcut')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 offset-md-2" id="printArea">
        <div class="card">
            <div class="card-block">
                <div class="view-info" id="debit_note_details"><div class="row">
                    <div class="col-lg-12">
                        <div class="general-info">
                            <div class="row">
                                <div class="col-lg-12 col-xl-12 col-md-12">
                                    <h6 class="text-white text-uppercase ml-3 bg-secondary p-2">Claim Information</h6>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Claim No.</th>
                                                    <td>
                                                        {{$claim->claim_no ?? ''}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Client</th>
                                                    <td>{{$claim->getClient->insured_name ?? ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Policy No.</th>
                                                    <td>{{$claim->getPolicy->policy_number ?? ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Business Class</th>
                                                    <td>{{$claim->getBusinessClass->class_name ?? ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Sub-business Class</th>
                                                    <td>{{$claim->getSubBusinessClass->class_name ?? ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Insurance Claim No.</th>
                                                    <td>{{$claim->insurance_claim_no ?? ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Date of Loss</th>
                                                    <td><label for="" class="label label-danger">{{date('d M, Y', strtotime($claim->loss_date))}}</label></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Date of Notification</th>
                                                    <td><label for="" class="label label-success">{{date('d M, Y', strtotime($claim->notification_date))}}</label></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Estimated Claim Amount</th>
                                                    <td>{{$claim->getCurrency->symbol}}{{number_format($claim->estimated_claim_amount,2)}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Insurance Company</th>
                                                    <td>{{$claim->getAgency->agent_name ?? ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Claim Description</th>
                                                    <td>{{$claim->claim_description ?? ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Status</th>
                                                    <td>
                                                        @if ($claim->status == 0)
                                                            <label class="label label-warning">Pending</label>
                                                        @elseif($claim->status == 1)
                                                            <label class="label label-success">Approved</label>
                                                        @elseif($claim->status == 2)
                                                            <label class="label label-danger">Declined</label>
                                                        @endif
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th>Claim Attachments</th>
                                                    <td>
                                                        <ul style="list-style-type: none;">
                                                            @foreach ($claim->getClaimAttachment as $attach)
                                                                <li style="float: left">
                                                                    <a href="/assets/attachments/{{$attach->attachment ?? ''}}">
                                                                        <img title="Download attachment" height="64" width="64" src="/assets/attachments/file.png" alt="Claim">
                                                                    </a>

                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Submitted By</th>
                                                    <td>
                                                        {{$claim->getSubmittedBy->first_name ?? ''}} {{$claim->getSubmittedBy->last_name ?? ''}}
                                                    </td>
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
                                                        {{$claim->getClient->insured_name ?? ''}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Email</th>
                                                    <td>{{$claim->getClient->email ?? ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Mobile No.</th>
                                                    <td>{{$claim->getClient->mobile_no ?? ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Address</th>
                                                    <td>{{$claim->getClient->address ?? ''}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-12 col-md-12">
                                    <h6 class="text-white text-uppercase ml-3 bg-secondary p-2">Policy Documentation</h6>
                                    <div class="table-responsive">
                                        <table class="table m-0">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Policy No.</th>
                                                    <td>{{ $claim->getPolicy->policy_number ?? '' }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Client No.</th>
                                                    <td>{{$claim->getPolicy->getBusinessClass->abbr}}/{{date('m',strtotime($claim->getPolicy->created_at))}}/{{date('y', strtotime($claim->getPolicy->created_at))}}/{{$claim->getPolicy->policy_number}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Insurance Policy No.</th>
                                                    <td>{{ $claim->getPolicy->insurance_policy_number ?? '' }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Business Class</th>
                                                    <td>{{ $claim->getPolicy->getBusinessClass->class_name ?? '' }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Sub-business Class</th>
                                                    <td>{{ $claim->getPolicy->getSubBusinessClass->class_name ?? '' }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Start Date</th>
                                                    <td>{{ !is_null($claim->getPolicy->start_date) ? date('d F, Y', strtotime($claim->getPolicy->start_date)) : '' }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">End Date</th>
                                                    <td>{{ !is_null($claim->getPolicy->end_date) ? date('d F, Y', strtotime($claim->getPolicy->end_date)) : '' }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Policy Type</th>
                                                    <td>{{ $claim->getPolicy->policy_type == 1 ? 'Non-motor Policy' : 'Motor Policy' }}</td>
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
        </div>
    </div>
</div>
<div class="row text-center">
    <div class="col-sm-12 filter-bar invoice-btn-group text-center">
        <div class="btn-group">
            <a href="{{url()->previous()}}" class="btn btn-secondary waves-effect m-b-10 btn-mini waves-light"><i class="icofont icofont-ui-block mr-2"></i> Cancel</a>
            <div class="dropdown-primary dropdown open">
                <button class="btn btn-primary btn-mini dropdown-toggle waves-effect waves-light " type="button" id="dropdown-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti-more-alt  mr-2"></i>More</button>
                <div class="dropdown-menu" aria-labelledby="dropdown-2" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -172px, 0px); top: 0px; left: 0px; will-change: transform;">
                    @if ($claim->status == 0)
                        <a class="dropdown-item waves-light waves-effect claim-action" href="javascript:void(0);" data-target="#claimActionModal" data-action="approve" data-toggle="modal">Approve Claim</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item waves-light waves-effect claim-action" href="javascript:void(0);" data-target="#claimActionModal" data-action="decline" data-toggle="modal">Decline Claim</a>
                        @endif
                    @if ($claim->status == 1)
                        <a class="dropdown-item waves-light waves-effect claim-action" href="javascript:void(0);" data-target="#claimActionModal" data-action="decline" data-toggle="modal">Decline Claim</a>

                    @elseif($claim->status == 2)
                        <a class="dropdown-item waves-light waves-effect claim-action" href="javascript:void(0);" data-target="#claimActionModal" data-action="approve" data-toggle="modal">Approve Claim</a>

                    @endif
                </div>
            </div>
            <a href="javascript:void(0);" id="printClaim" class="btn btn-success btn-print-invoice m-b-10 btn-mini waves-effect waves-light m-r-20"><i class="ti-printer mr-2"></i>Print</a>

        </div>
    </div>
</div>
@endsection

@section('dialog-section')
<div class="modal fade" id="claimActionModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Are you sure you want to <strong id="action_name"></strong> this claim?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <p class="text-center">This action will update the status of this claim. <br> <i>Are you sure you'll like to continue?</i></p>
                <input type="hidden" id="claim" value="{{$claim->id}}" name="claim">
                <hr>
                <div class="btn-group d-flex justify-content-center">
                    <button class="btn btn-secondary btn-mini" data-dismiss="modal"><i class="ti-close mr-2"></i>Cancel</button>
                    @if ($claim->status == 0)
                        <button class="btn btn-mini btn-primary" id="approveClaimBtn"><i class="ti-check mr-2"></i>Approve</button>
                        <button class="btn btn-mini btn-danger" id="declineClaimBtn"><i class="ti-check mr-2"></i>Decline</button>
                    @endif
                    @if ($claim->status == 1)
                        <button class="btn btn-mini btn-danger" id="declineClaimBtn"><i class="ti-check mr-2"></i>Decline</button>
                    @elseif($claim->status == 2)
                        <button class="btn btn-mini btn-primary" id="approveClaimBtn"><i class="ti-check mr-2"></i>Approve</button>

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
<script src="/assets/js/printThis.js"></script>
<script src="/assets/js/toastify.min.js"></script>
<script src="/assets/js/axios.min.js"></script>
<script>
    $(document).ready(function(){
        $(document).on('click', '.claim-action',function(e){
            e.preventDefault();
            var action = $(this).data('action');
            $('#action_name').text(action);
        });

        $(document).on('click', '#approveClaimBtn', function(e){
            e.preventDefault();
            var claim = $('#claim').val();
            axios.post('/policy/claim/update-claim',{status:1,claim:claim})
            .then(response=>{
                $('#claimActionModal').modal('hide');
                Toastify({
                    text: "Success! Claim approved.",
                    duration: 3000,
                    newWindow: true,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    onClick: function(){} // Callback after click
                    }).showToast();
                location.reload();
            });
        });
        $(document).on('click', '#declineClaimBtn', function(e){
            e.preventDefault();
            var claim = $('#claim').val();
            axios.post('/policy/claim/update-claim',{status:2,claim:claim})
            .then(response=>{
                $('#claimActionModal').modal('hide');
                Toastify({
                    text: "Success! Claim declined.",
                    duration: 3000,
                    newWindow: true,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    onClick: function(){} // Callback after click
                    }).showToast();
                location.reload();
            });
        });
        $(document).on('click', '#printClaim', function(event){
            $('#printArea').printThis();
        });
    });
</script>
@endsection
