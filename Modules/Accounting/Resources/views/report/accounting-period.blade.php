@extends('layouts.master')

@section('title')
    Trial Balance
@endsection
@section('extra-styles')

@endsection
@section('current-page')
    Trial Balance
@endsection
@section('current-page-brief')
    Trial Balance
@endsection
@section('main-content')
<div class="card">
    <div class="card-block">
        <h5 class="sub-title">Accounting Period</h5>
        @if (session()->has('success'))
            <div class="alert alert-success background-success mt-3">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="icofont icofont-close-line-circled text-white"></i>
                </button>
                {!! session()->get('success') !!}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-warning background-warning mt-3">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="icofont icofont-close-line-circled text-white"></i>
                </button>
                {!! session()->get('error') !!}
            </div>
        @endif
        <p>Selecting accounting period to generate trial balance</p>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <form action="{{url('/accounting/trial-balance')}}" method="post">
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

    </div>
</div>
@endsection

@section('dialog-section')

@endsection

@section('extra-scripts')

@endsection
