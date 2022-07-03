@extends('layouts.master')

@section('title')
    NAICOM Report
@endsection

@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\css\toastify.min.css">
    <link rel="stylesheet" type="text/css" href="\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
@endsection
@section('current-page')
    NAICOM Report
@endsection
@section('current-page-brief')
    <p>NAICOM report</p>
@endsection
@section('main-content')

    @include('policy::partials._report-shortcut')
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <form action="{{url('/accounting/profit-or-loss')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-sm-12 col-md-8 col-lg-8">
                        <div class="input-group input-group-button">
                            <span class="input-group-addon btn btn-primary" id="basic-addon11">
                                <span class="">From</span>
                            </span>
                            <input type="date" name="from" class="form-control" placeholder="From">
                            <span class="input-group-addon btn btn-primary" id="basic-addon12">
                                <span class="">To</span>
                            </span>
                            <input type="date" name="to" class="form-control" placeholder="To">
                            <span class="input-group-addon btn btn-primary" id="basic-addon12">
                               <button class="btn  btn-primary" type="submit">Submit</button>
                            </span>
                        </div>
                        @error('from')
                        <i class="text-danger mt-2">{{$message}}</i> <br>
                        @enderror
                        @error('to')
                        <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                </div>

            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-block">
                    <h5 class="sub-title">NAICOM Report <code>(Current Year - {{date('Y')}})</code></h5>
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
                                <th>Date</th>
                                <th>Client No.</th>
                                <th>Endorsement No.</th>
                                <th>Transaction Type</th>
                                <th>From Date</th>
                                <th>To Date</th>
                                <th>Name of Assured</th>
                                <th>Customer Name</th>
                                <th>Other Brokers/Agents</th>
                                <th>Sum Insured</th>
                                <th>Gross Premium</th>
                                <th>Commission</th>
                                <th>Net Premium Due</th>
                                <th>Policy Tenure(Days)</th>
                                <th>End Date</th>
                                <th>Debit Note No.</th>
                                <th>Credit Note No.</th>
                                <th>Amount Received</th>
                                <th>Receipt Date of Premium</th>
                                <th>Receipt No. (To Insured)</th>
                                <th>Name of Bank of Lodgement</th>
                                <th>Date of Lodgement</th>
                                <th>Name of Insurer</th>
                                <th>Amount Due</th>
                                <th>Amount Remitted</th>
                                <th>Un-remitted</th>
                                <th>Date Paid</th>
                                <th>Name of Bank</th>
                                <th>Cheque No.</th>
                                <th>Receipt No.</th>
                                <th>Date of Bal.</th>
                                <th>Remarks</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $serial = 1;
                            @endphp

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Client No.</th>
                                <th>Endorsement No.</th>
                                <th>Transaction Type</th>
                                <th>From Date</th>
                                <th>To Date</th>
                                <th>Name of Assured</th>
                                <th>Customer Name</th>
                                <th>Other Brokers/Agents</th>
                                <th>Sum Insured</th>
                                <th>Gross Premium</th>
                                <th>Commission</th>
                                <th>Net Premium Due</th>
                                <th>Policy Tenure(Days)</th>
                                <th>End Date</th>
                                <th>Debit Note No.</th>
                                <th>Credit Note No.</th>
                                <th>Amount Received</th>
                                <th>Receipt Date of Premium</th>
                                <th>Receipt No. (To Insured)</th>
                                <th>Name of Bank of Lodgement</th>
                                <th>Date of Lodgement</th>
                                <th>Name of Insurer</th>
                                <th>Amount Due</th>
                                <th>Amount Remitted</th>
                                <th>Un-remitted</th>
                                <th>Date Paid</th>
                                <th>Name of Bank</th>
                                <th>Cheque No.</th>
                                <th>Receipt No.</th>
                                <th>Date of Bal.</th>
                                <th>Remarks</th>
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
