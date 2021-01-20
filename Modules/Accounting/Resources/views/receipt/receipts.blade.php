@extends('layouts.master')

@section('title')
    All Receipts
@endsection

@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\css\toastify.min.css">
    <link rel="stylesheet" type="text/css" href="\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
@endsection
@section('current-page')
    All Receipts
@endsection
@section('current-page-brief')
    All Receipts
@endsection
@section('main-content')


<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
            <div class="card-block-small">
                <i class="feather icon-home bg-c-pink card1-icon"></i>
                <span class="text-c-pink f-w-600">Total</span>
                <h4>{{number_format($receipts->count())}}</h4>
                <div>
                    <span class="f-left m-t-10 text-muted">
                        <i class="text-c-pink f-16 feather icon-calendar m-r-10"></i>Overall number of receipts
                    </span>
                </div>
            </div>
        </div>
    </div>
   <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
            <div class="card-block-small">
                <i class="feather icon-pie-chart bg-c-blue card1-icon"></i>
                <span class="text-c-blue f-w-600">Total</span>
                <h4>{{number_format($receipts->sum('amount'),2)}}</h4>
                <div>
                    <span class="f-left m-t-10 text-muted">
                        <i class="text-c-blue f-16 feather icon-alert-triangle m-r-10"></i>Overall amount
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
            <div class="card-block-small">
                <i class="ti-shopping-cart bg-c-green card1-icon"></i>
                <span class="text-c-green f-w-600">Total</span>
                <h4>{{number_format($receipts->where('status',0)->sum('amount'),2)}}</h4>
                <div>
                    <span class="f-left m-t-10 text-muted">
                        <i class="text-c-green f-16 feather icon-tag m-r-10"></i>Amount pending
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
            <div class="card-block-small">
                <i class="ti-receipt bg-c-yellow card1-icon"></i>
                <span class="text-c-yellow f-w-600">Total</span>
                <h4>{{number_format($receipts->where('status',1)->sum('amount'),2)}}</h4>
                <div>
                    <span class="f-left m-t-10 text-muted">
                        <i class="text-c-yellow f-16 feather icon-watch m-r-10"></i>Amount approved
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
                <h5 class="sub-title text-primary">All Receipts</h5>
                <p>A total of <label for="" class="badge badge-danger">{{number_format($receipts->count())}}</label> receipt(s) generated since inception. </p>
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
                                <th>Receipt No.</th>
                                <th>Debit Code</th>
                                <th>Account</th>
                                <th>Insured Name</th>
                                <th>Amount</th>
                                <th>Payment Mode</th>
                                <th>Payment Type</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
							$index = 1;
							@endphp
                            @foreach ($receipts as $receipt)
                                <tr>
                                    <td>{{$index++}}</td>
                                    <td>{{$receipt->receipt_no ?? ''}}</td>
                                    <td>{{$receipt->debit_code ?? ''}}</td>
                                    <td>{{$receipt->getAccount->account_name ?? ''}} - {{$receipt->getAccount->glcode ?? ''}}</td>
                                    <td>{{$receipt->getClient->insured_name ?? ''}}</td>
                                    <td>{{$receipt->getCurrency->symbol ?? 'N'}}{{number_format($receipt->amount,2)}}</td>
                                    <td>
                                        @if ($receipt->payment_mode == 1)
                                            Cash
                                        @elseif($receipt->payment_mode == 2)
                                            Bank Transfer
                                        @elseif($receipt->payment_mode == 3)
                                            Cheque
                                        @endif
                                    </td>
                                    <td>
                                        @if ($receipt->payment_type == 1)
                                            Full Payment
                                        @elseif($receipt->payment_mode == 2)
                                            Part Payment
                                        @endif
                                    </td>
                                    <td>
                                        @if ($receipt->status == 0)
                                            <label class="label label-warning">Pending</label>
                                        @elseif($receipt->status == 1)
                                            <label class="label label-success">Complete</label>

                                        @endif
                                    </td>
                                    <td>
                                        {{date('d M, Y', strtotime($receipt->created_at))}}
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-primary btn-mini">Learn more</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Receipt No.</th>
                                <th>Debit Code</th>
                                <th>Account</th>
                                <th>Insured Name</th>
                                <th>Amount</th>
                                <th>Payment Mode</th>
                                <th>Payment Type</th>
                                <th>Status</th>
                                <th>Date</th>
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
