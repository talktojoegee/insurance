@extends('layouts.master')

@section('title')
    All Claims
@endsection

@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\css\toastify.min.css">
    <link rel="stylesheet" type="text/css" href="\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
@endsection

@section('current-page')
    All Claims
@endsection
@section('current-page-brief')
    List of all claims.
@endsection
@section('main-content')



@include('policy::partials._policy-shortcut')

<div class="row">
    <div class="col-md-12 col-xl-4">
        <div class="card widget-statstic-card">
            <div class="card-header">
                <div class="card-header-left">
                    <h5>Statistics</h5>
                    <p class="p-t-10 m-b-0 text-c-yellow">Pending</p>
                </div>
            </div>
            <div class="card-block">
                <i class="feather icon-sliders st-icon bg-c-yellow"></i>
                <div class="text-left">
                    <h3 class="d-inline-block">{{number_format($claims->where('status', 0)->count())}}</h3>
                    <i class="icofont icofont-sand-clock f-30 text-c-green"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-xl-4">
        <div class="card widget-statstic-card">
            <div class="card-header">
                <div class="card-header-left">
                    <h5>Statistics</h5>
                    <p class="p-t-10 m-b-0 text-c-green">Approved</p>
                </div>
            </div>
            <div class="card-block">
                <i class="feather icon-sliders st-icon bg-c-green"></i>
                <div class="text-left">
                    <h3 class="d-inline-block">{{number_format($claims->where('status',1)->count())}}</h3>
                    <i class="icofont icofont-ui-check f-30 text-c-green"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-xl-4">
        <div class="card widget-statstic-card">
            <div class="card-header">
                <div class="card-header-left">
                    <h5>Statistics</h5>
                    <p class="p-t-10 m-b-0 text-c-pink">Declined</p>
                </div>
            </div>
            <div class="card-block">
                <i class="feather icon-sliders st-icon bg-c-pink"></i>
                <div class="text-left">
                    <h3 class="d-inline-block">{{number_format($claims->where('status',2)->count())}}</h3>
                    <i class="icofont icofont-ui-close f-30 text-c-pink"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-block">
                <h5 class="sub-title text-primary">All Credit Notes</h5>
                <p>A total of <label for="" class="badge badge-danger">{{number_format($claims->count())}}</label> credit note(s) have been raised since inception. </p>
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
                            @foreach ($claims as $item)
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

@endsection

@section('extra-scripts')

<script src="\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>

<script src="\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
<script src="\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
<script src="\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>

<script src="\assets\pages\data-table\js\data-table-custom.js"></script>
@endsection
