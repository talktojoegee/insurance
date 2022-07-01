@extends('layouts.master')

@section('title')
    Journal Details
@endsection
@section('current-page')
    Journal Details
@endsection
@section('current-page-brief')
    Journal Details
@endsection
@section('main-content')

    <div class="row ">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header mb-4">
                    <h5 class="card-header-text text-uppercase">Journal Voucher</h5>
                    <a href="{{route('manage-journal-voucher')}}" class="btn btn-mini btn-primary float-right" ><i class="ti-plus mr-2"></i>Mange Journal Entries</a>
                </div>
                <div class="card-block">
                    @if (session()->has('success'))
                        <div class="alert alert-success background-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    <form action="{{route('process-journal-entry')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="">Operation</label>
                                <select name="operation" id="operation" class="form-control">
                                    <option disabled selected>--Select Operation--</option>
                                    <option value="1">Post Journal</option>
                                    <option value="2">Discard Journal</option>
                                </select>
                                @error('operation')
                                <i class="text-danger">{{$message}}</i>
                                @enderror
                            </div>

                        </div>
                        <div class="table-responsive">
                            <table class="table table-styling">
                                <thead>
                                <tr class="table-primary">
                                    <th>#</th>
                                    <th>Account</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $serial = 1; @endphp
                                @foreach($entries as $entry)
                                    <tr>
                                        <th scope="row">{{$serial++}}</th>
                                        <td>
                                            {{$entry->getAccountByGlCode->account_name ?? '' }} <i style="cursor: pointer;" title="{{$entry->narration ?? ''}}">?</i>
                                        </td>
                                        <td>
                                            {{number_format($entry->dr_amount,2)}}
                                        </td>
                                        <td>
                                            {{number_format($entry->cr_amount,2)}}
                                        </td>
                                        <td>{{date('d M, Y', strtotime($entry->entry_date))}}</td>
                                    </tr>
                                    <input type="hidden" name="journalId[]" value="{{$entry->id}}">
                                @endforeach
                                <tr>
                                    <td colspan="2" class="text-right"><strong>Total</strong></td>
                                    <td>{{number_format($entries->sum('dr_amount'),2)}}</td>
                                    <td>{{number_format($entries->sum('cr_amount'),2)}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group d-flex justify-content-center">
                            <button class="btn btn-primary btn-sm">Submit Journal Voucher</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('dialog-section')

@endsection

@section('extra-scripts')


@endsection
