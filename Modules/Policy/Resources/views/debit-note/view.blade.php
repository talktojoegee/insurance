@extends('layouts.master')

@section('title')
    Debit Note Details
@endsection

@section('extra-styles')

@endsection
@section('current-page')
    Debit Note Details
@endsection
@section('current-page-brief')
    Details of Debit note {{$debit->debit_code ?? ''}}
@endsection
@section('main-content')

@include('policy::partials._policy-shortcut')
    <div class="container">
        <div>
            <div class="card">
                <div class="row invoice-contact">
                    <div class="col-md-8">
                        <div class="invoice-box row">
                            <div class="col-sm-12">
                                <table class="table table-responsive invoice-table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td><img src="..\files\assets\images\logo-blue.png" class="m-b-10" alt=""></td>
                                        </tr>
                                        <tr>
                                            <td>Compney Name</td>
                                        </tr>
                                        <tr>
                                            <td>123 6th St. Melbourne, FL 32904 West Chicago, IL 60185</td>
                                        </tr>
                                        <tr>
                                            <td><a href="..\..\..\cdn-cgi\l\email-protection.htm#99fdfcf4f6d9fef4f8f0f5b7faf6f4" target="_top"><span class="__cf_email__" data-cfemail="690d0c0406290e04080005470a0604">[email&#160;protected]</span></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>+91 919-91-91-919</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                    </div>
                </div>
                <div class="card-block">
                    <div class="row invoive-info">
                        <div class="col-md-4 col-xs-12 invoice-client-info">
                            <h6>Policy Documentation:</h6>

                        </div>
                        <div class="col-md-4 col-sm-6">
                            <h6>Client Information:</h6>

                        </div>
                        <div class="col-md-4 col-sm-6">
                            <h6 class="m-b-20">Payment Information:</h6>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-sm-12 filter-bar invoice-btn-group text-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger waves-effect m-b-10 btn-mini waves-light"><i class="icofont icofont-ui-block mr-2"></i> Cancel</button>
                        <button type="button" class="btn btn-primary btn-print-invoice m-b-10 btn-mini waves-effect waves-light m-r-20"><i class="ti-printer mr-2"></i>Print</button>
                        <button type="button" class="btn btn-warning btn-print-invoice m-b-10 btn-mini waves-effect waves-light m-r-20"><i class="ti-pencil mr-2"></i>Edit</button>
                        <button type="button" class="btn btn-danger btn-print-invoice m-b-10 btn-mini waves-effect waves-light m-r-20"><i class="ti-trash mr-2"></i>Delete</button>
                        <a href=" url('/policy/debit-note/new/'.$policy->slug) }}" class="btn btn-success btn-print-invoice m-b-10 btn-mini waves-effect waves-light m-r-20"><i class="ti-check mr-2"></i>Raise Credit Note</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')

@endsection
