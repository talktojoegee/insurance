@extends('layouts.master')

@section('title')
    Journal Vouchers
@endsection
@section('current-page')
    Journal Vouchers
@endsection
@section('current-page-brief')
    Journal Vouchers
@endsection
@section('main-content')

<div class="row ">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header mb-4">
                <h5 class="card-header-text text-uppercase">Journal Voucher</h5>
                <a href="{{url('accounting/new-journal-voucher')}}" class="btn btn-mini btn-primary float-right" ><i class="ti-plus mr-2"></i>Add New Entry</a>
            </div>
            <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Account</th>
                            <th>Narration</th>
                            <th> DR Amount</th>
                            <th> CR Amount</th>
                            <th> Posted</th>
                            <th> Discarded</th>
                            <th> JV Date</th>
                            <th>Entry By</th>
                            <th>Entry Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $serial = 1;
                        @endphp
                        @foreach($entries as $entry)
                            <tr>
                                <td>{{$serial++}}</td>
                                <td>{{$entry->account_name ?? ''}} - ({{$entry->glcode}})</td>
                                <td>{{$entry->narration ?? ''}}</td>
                                <td>N{{number_format($entry->dr_amount,2) ?? ''}}</td>
                                <td>N{{number_format($entry->cr_amount,2) ?? ''}}</td>
                                <td>{!! $entry->posted == 1 ? "<label class='badge badge-success'>Posted</label>" : '-' !!}</td>
                                <td>{!! $entry->trash == 1 ? "<label class='badge badge-danger'>Discarded</label>" :  '-' !!}</td>
                                <td>{{!is_null($entry->jv_date ) ? date('d F, Y', strtotime($entry->jv_date )) : '-'}}</td>
                                <td>{{$entry->first_name ?? ''}} {{$entry->last_name ?? ''}}</td>
                                <td>{{!is_null($entry->entry_date ) ? date('d F, Y', strtotime($entry->entry_date )) : '-'}}</td>
                                <td>
                                    <a href="{{route('view-journal-entry', $entry->ref_no)}}" class="btn btn-mini btn-info">Learn more</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Account</th>
                            <th>Narration</th>
                            <th> DR Amount</th>
                            <th> CR Amount</th>
                            <th> Ref. No.</th>
                            <th> JV Date</th>
                            <th>Entry By</th>
                            <th>Entry Date</th>
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

@section('dialog-section')

@endsection

@section('extra-scripts')
<script src="\assets\js\axios.min.js"></script>

@endsection
