@extends('layouts.master')

@section('title')
    All Credit Notes
@endsection

@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\css\toastify.min.css">
    <link rel="stylesheet" type="text/css" href="\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
@endsection

@section('current-page')
    All Credit Notes
@endsection
@section('current-page-brief')
    List of all credit notes raised.
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
@include('policy::partials._policy-shortcut')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-block">
                <h5 class="sub-title text-primary">All Credit Notes</h5>
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
                                <th>Debit Code</th>
                                <th>Client No.</th>
                                <th>Insured</th>
                                <th>Cover Days</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Insurance Company.</th>
                                <th>Option</th>
                                <th>Business Type</th>
                                <th>Business Class</th>
                                <th>Sub Class</th>
                                <th>Currency</th>
                                <th>Sum Insured</th>
                                <th>Premium Rate</th>
                                <th>Gross Premium</th>
                                <th>Commission Rate</th>
                                <th>Commission</th>
                                <th>VAT Rate</th>
                                <th>VAT</th>
                                <th>Exchange Rate</th>
                                <th>Net Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
							$index = 1;
							@endphp
							@if(count($list) > 0)

							@else
							    <h2>No record found</h2>
							@endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Debit Code</th>
                                <th>Client No.</th>
                                <th>Insured</th>
                                <th>Cover Days</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Insurance Company.</th>
                                <th>Option</th>
                                <th>Business Type</th>
                                <th>Business Class</th>
                                <th>Sub Class</th>
                                <th>Currency</th>
                                <th>Sum Insured</th>
                                <th>Premium Rate</th>
                                <th>Gross Premium</th>
                                <th>Commission Rate</th>
                                <th>Commission</th>
                                <th>VAT Rate</th>
                                <th>VAT</th>
                                <th>Exchange Rate</th>
                                <th>Net Amount</th>
                                <th>Status</th>
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