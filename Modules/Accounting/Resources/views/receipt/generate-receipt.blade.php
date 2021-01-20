@extends('layouts.master')

@section('title')
    Generate Receipt
@endsection
@section('extra-styles')
<link rel="stylesheet" href="/assets/css/select2.min.css">
@endsection
@section('current-page')
    Generate Receipt
@endsection
@section('current-page-brief')
    Generate Receipt
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
                        <h5 class="sub-title">Generate New Receipt</h5>
                        <form action="{{url('/accounting/generate-receipt')}}" method="post" autocomplete="off">
                            @csrf
                            <div class="form-group">
                                <label for="">Debit Code/Number</label>
                                <input type="number" placeholder="Debit Code/Number" id="debit_code" name="debit_code" class="form-control">
                                @error('debit_code')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Receipt Number</label>
                                <input type="number" readonly placeholder="Receipt Number" id="receipt_no" value="{{$receiptNo}}" name="receipt_no" class="form-control">
                                @error('receipt_no')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Bank</label>
                                <select name="bank" id="bank" class="form-control js-example-basic-single">
                                    <option disabled selected>--Select bank--</option>
                                    @foreach ($accounts as $account)
                                        <option value="{{$account->glcode}}">{{$account->account_name ?? ''}} - {{$account->glcode ?? ''}}</option>
                                    @endforeach
                                </select>
                                @error('bank')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Transaction Date</label>
                                <input type="date" class="form-control" name="transaction_date" id="transaction_date" placeholder="dd/mm/yyyy">
                                @error('transaction_date')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Payment Type</label>
                                <select name="payment_type" id="payment_type" class="form-control">
                                    <option disabled selected>--Select payment type--</option>
                                    <option value="1">Full payment</option>
                                    <option value="2">Part payment</option>
                                    <option value="3">Balance payment</option>
                                </select>
                                @error('payment_type')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Payment Mode</label>
                                <select name="payment_mode" id="payment_mode" class="form-control">
                                    <option disabled selected>--Select payment mode--</option>
                                    <option value="1">Cash</option>
                                    <option value="2">Bank Transfer</option>
                                    <option value="3">Cheque</option>
                                    <option value="4">To be adviced</option>
                                </select>
                                @error('payment_mode')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Amount</label>
                                <input type="number" step="0.01" placeholder="Amount" name="amount"  class="form-control">
                                @error('amount')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Currency</label>
                                <select name="currency" id="currency" class="form-control js-example-basic-single">
                                    <option disabled selected>--Select currency--</option>
                                    @foreach ($currencies as $currency)
                                        <option value="{{$currency->id}}">{{$currency->name ?? ''}} ({{$currency->symbol ?? ''}})</option>
                                    @endforeach
                                </select>
                                @error('currency')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                @enderror
                            </div>
                            <hr>
                            <div class="form-group d-flex justify-content-center">
                                <div class="btn-group">
                                    <a href="" class="btn btn-danger btn-mini"><i class="ti-close mr-2"></i>Cancel</a>
                                    <button type="submit" class="btn btn-primary btn-mini"><i class="ti-check mr-2"></i>Generate Receipt</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="card">
                    <div class="card-block">
                        <h5 class="sub-title">Debit Note Preview</h5>
                        <div class="view-info" id="debit_note_details">

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
<script type="text/javascript" src="/assets/js/select2.min.js"></script>
<script type="text/javascript" src="/assets/js/axios.min.js"></script>
<script>
    $(document).ready(function(){
        $('.js-example-basic-single').select2();
        $(document).on('blur', '#debit_code', function(e){
            e.preventDefault();
            axios.post('/accounting/get-debit-note-details',{debit_code:$(this).val()})
            .then(response=>{
                $('#debit_note_details').html(response.data);
            });
        });
    });
</script>
@endsection
