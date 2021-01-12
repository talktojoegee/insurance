@extends('layouts.master')

@section('title')
    Clients
@endsection

@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\css\toastify.min.css">
    <link rel="stylesheet" type="text/css" href="\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
@endsection
@section('main-content')


<div class="row">
   <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
            <div class="card-block-small">
                <i class="icofont icofont-notepad bg-c-blue card1-icon"></i>
                <span class="text-c-blue f-w-600">Total</span>
                <h4>{{number_format($clients->count())}}</h4>
                <div>
                    <span class="f-left m-t-10 text-muted">
                        <i class="text-c-blue f-16 feather icon-alert-triangle m-r-10"></i>All Time
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
            <div class="card-block-small">
                <i class="icofont icofont-calendar bg-c-pink card1-icon"></i>
                <span class="text-c-pink f-w-600">Total</span>
                <h4>$23,589</h4>
                <div>
                    <span class="f-left m-t-10 text-muted">
                        <i class="text-c-pink f-16 feather icon-calendar m-r-10"></i>Last Month
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
            <div class="card-block-small">
                <i class="icofont icofont-calendar bg-c-green card1-icon"></i>
                <span class="text-c-green f-w-600">Total</span>
                <h4>45</h4>
                <div>
                    <span class="f-left m-t-10 text-muted">
                        <i class="text-c-green f-16 feather icon-tag m-r-10"></i>This Month
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
            <div class="card-block-small">
                <i class="icofont icofont-calendar bg-c-yellow card1-icon"></i>
                <span class="text-c-yellow f-w-600">Total</span>
                <h4>+562</h4>
                <div>
                    <span class="f-left m-t-10 text-muted">
                        <i class="text-c-yellow f-16 feather icon-watch m-r-10"></i>This Week
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
                <h5 class="sub-title">Clients</h5>
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
                                <th>Insured Name</th>
                                <th>Email</th>
                                <th>Mobile No.</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $serial = 1;
                            @endphp
                            @foreach ($clients as $client)
                                <tr>
                                    <td>{{$serial++}}</td>
                                    <td>{{$client->insured_name ?? ''}}</td>
                                    <td>{{$client->email ?? ''}}</td>
                                    <td>{{$client->mobile_no ?? ''}}</td>
                                    <td>{{$client->address ?? ''}}</td>
                                    <td>
                                        <a class="btn btn-primary btn-mini" href="/policy/client/view/{{$client->slug}}">Learn more</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Insured Name</th>
                                <th>Email</th>
                                <th>Mobile No.</th>
                                <th>Address</th>
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
