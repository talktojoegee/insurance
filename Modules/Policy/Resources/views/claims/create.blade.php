@extends('layouts.master')

@section('title')
    Add New Claim
@endsection
@section('extra-styles')
    <style type="text/css">
        .label{
            padding: 1px 4px !important;
        }
    </style>
    <link rel="stylesheet" href="/assets/css/select2.min.css">
@endsection
@section('current-page')
    Add New Claim
@endsection
@section('current-page-brief')
    Register a new claim.
@endsection
@section('main-content')
<div class="row">
    <div class="col-xl-12 col-lg-12  filter-bar">
        <nav class="navbar navbar-light bg-faded m-b-30 p-10 d-flex justify-content-end">
            <div class="nav-item nav-grid" style="margin-right: 150px;">
                <div class="dropdown-primary dropdown open">
                    <button class="btn btn-primary btn-mini dropdown-toggle waves-effect waves-light " type="button" id="dropdown-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Menu</button>
                    <div class="dropdown-menu" aria-labelledby="dropdown-2" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 39px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item waves-light waves-effect" href="#">Chart of Accounts</a>
                        <a class="dropdown-item waves-light waves-effect" href="#">Journal Voucher</a>
                        <a class="dropdown-item waves-light waves-effect" href="#">Trial Balance</a>
                        <a class="dropdown-item waves-light waves-effect" href="#">Income Statement</a>
                        <a class="dropdown-item waves-light waves-effect" href="#">Generate Receipt</a>
                        <a class="dropdown-item waves-light waves-effect" href="#">All Receipts</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item waves-light waves-effect" href="#">All Invoices</a>
                    </div>
                </div>
            </div>

        </nav>
    </div>
</div>

<div class="card">
    <div class="card-block">
        <div class="row ">
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="card">
                    <div class="card-block">
                        <h5 class="sub-title">Add New Claim</h5>
                        <form action="{{url('/policy/claim/register-claim')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Insured Name</label>
                                <select name="insured_name" id="client" class="form-control js-example-basic-single">
                                    <option disabled selected>--Select insured name--</option>
                                    @foreach ($clients as $client)
                                        <option value="{{$client->id}}">{{$client->insured_name ?? ''}}</option>
                                    @endforeach
                                </select>
                                @error('insured_name')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Policy No.</label>
                                <div id="policyWrapper"></div>

                                @error('policy_no')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Claim Number</label>
                                <input type="number" readonly value="{{$claimNo}}" placeholder="Claim Number" id="claim_no" name="claim_no" class="form-control">
                                @error('claim_no')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Insurance Claim Number</label>
                                <input type="number" value="{{old('insurance_claim_no')}}"  placeholder="Insurance Claim Number" id="insurance_claim_no" name="insurance_claim_no" class="form-control">
                                @error('insurance_claim_no')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Date of Loss</label>
                                <input type="date"  placeholder="Date of Loss" id="date_of_loss" name="date_of_loss" class="form-control">
                                @error('date_of_loss')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Date of Notification</label>
                                <input type="date"  placeholder="Date of Notification" id="date_of_notification" name="date_of_notification" class="form-control">
                                @error('date_of_notification')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Estimated Claim Amount</label>
                                <input type="number" step="0.01" value="{{old('estimated_claim_amount')}}"  placeholder="Estimated Claim Amount" id="estimated_claim_amount" name="estimated_claim_amount" class="form-control">
                                @error('estimated_claim_amount')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Claim Attachment Documents</label>
                                <input type="file"  id="claim_attachment_documents" name="claim_attachment_documents[]" multiple class="form-control-file">
                                @error('claim_attachment_documents')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Claim Description</label>
                                <textarea name="claim_description" value="{{old('claim_description')}}" class="form-control" id="claim_description" placeholder="Claim Description..." style="resize: none;"></textarea>
                                @error('claim_description')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                            <hr>
                            <div class="form-group d-flex justify-content-center">
                                <div class="btn-group">
                                    <a href="{{url()->previous()}}" class="btn btn-danger btn-mini"><i class="ti-close mr-2"></i>Cancel</a>
                                    <button type="submit" class="btn btn-primary btn-mini"><i class="ti-check mr-2"></i>Submit Claim</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="card">
                    <div class="card-block">
                        <h5 class="sub-title">Policy Documentation</h5>
                        <div class="view-info" id="policy_documentation_detail">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('dialog-section')
@endsection

@section('extra-scripts')
<script type="text/javascript" src="/assets/js/axios.min.js"></script>
<script type="text/javascript" src="/assets/js/select2.min.js"></script>
<script>
    $(document).ready(function(){
        $('.js-example-basic-single').select2();
        $(document).on('change', '#client', function(e){
            e.preventDefault();
            axios.post('/policy/claim/get-policies',{client:$(this).val()})
            .then(response=>{
                $('#policyWrapper').html(response.data);
                $('.js-example-basic-single').select2();
            });
        });
        $(document).on('change', '#policy_no', function(e){
            e.preventDefault();
            axios.post('/policy/claim/get-client-policy',{client:$('#client').val(), policy:$(this).val()})
            .then(response=>{
                $('#policy_documentation_detail').html(response.data);
                $('.js-example-basic-single').select2();
            });
        });
    });
</script>
@endsection
