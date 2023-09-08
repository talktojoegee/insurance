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
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12" id="printArea">
        <div class="card">
            <div class="card-block">
                <table class="table table-responsive invoice-table table-borderless">
                    <tbody>
                    <tr>
                        <td><img src="/assets/attachments/assets/logo/{{$settings->company_logo ?? 'logo.jpg'}}" height="94" width="150" class="m-b-10" alt="{{config('app.name')}}"></td>
                    </tr>
                    <tr>
                        <td>{{$settings->office_address ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><a href="javascript:void(0);" target="_top"><span >{{$settings->official_email ?? '' }}</span></a>
                        </td>
                    </tr>
                    <tr>
                        <td>{{$settings->office_phone_1 ?? ''}} {{!is_null($settings->office_phone_2) ? ', '.$settings->office_phone_2  : ''}}</td>
                    </tr>
                    </tbody>
                </table>
                <div class="view-info" id="debit_note_details"><div class="row">
                    <div class="col-lg-12">
                        <div class="general-info">
                            <div class="row">
                                <div class="col-lg-12 col-xl-12 col-md-12">
                                    <h6 class="text-white text-uppercase ml-3 bg-secondary p-2">Client Information</h6>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Insured Name</th>
                                                    <td>
                                                        {{$debit->getClient->insured_name ?? ''}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Email</th>
                                                    <td>{{$debit->getClient->email ?? ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Mobile No.</th>
                                                    <td>{{$debit->getClient->mobile_no ?? ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Address</th>
                                                    <td>{{$debit->getClient->address ?? ''}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-12 col-md-12">
                                    <h6 class="text-white text-uppercase ml-3 bg-secondary p-2">Payment Information</h6>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Sum Insured</th>
                                                    <td>{{$debit->getCurrency->symbol ?? ''}}{{number_format($debit->sum_insured,2)}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Currency</th>
                                                    <td>{{$debit->getCurrency->name ?? '-'}} ({{$debit->getCurrency->symbol ?? ''}})</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Premium Rate</th>
                                                    <td>{{$debit->premium_rate.'%' ?? '-'}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Gross Premium</th>
                                                    <td>{{$debit->getCurrency->symbol ?? ''}}{{number_format($debit->gross_premium,2)}}</td>
                                                </tr>
                                                <tr class="commission">
                                                    <th scope="row">Commission Rate</th>
                                                    <td>{{$debit->commission_rate.'%' ?? '-'}}</td>
                                                </tr>
                                                <tr class="commission">
                                                    <th scope="row">Commission</th>
                                                    <td>{{$debit->getCurrency->symbol ?? ''}}{{number_format($debit->commission,2)}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Exchange Rate</th>
                                                    <td>{{$debit->exchange_rate}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Net Amount</th>
                                                    <td>{{$debit->getCurrency->symbol ?? ''}}{{number_format($debit->net_amount,2)}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Agency</th>
                                                    <td>{{$debit->getAgency->agent_name ?? ''}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row text-center">
    <div class="col-sm-12 filter-bar invoice-btn-group text-center">
        <div class="btn-group">
            <button type="button" class="btn btn-danger waves-effect m-b-10 btn-mini waves-light"><i class="icofont icofont-ui-block mr-2"></i> Cancel</button>
            <div class="dropdown-primary dropdown open">
                <button class="btn btn-primary btn-mini dropdown-toggle waves-effect waves-light " type="button" id="dropdown-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti-more-alt  mr-2"></i>More</button>
                <div class="dropdown-menu" aria-labelledby="dropdown-2" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -172px, 0px); top: 0px; left: 0px; will-change: transform;">
                    <a class="dropdown-item waves-light waves-effect" id="withCommission" href="javascript:void(0);">Print With Commission</a>
                    <a class="dropdown-item waves-light waves-effect" id="withoutCommission" href="javascript:void(0);">Print Without Commission</a>
                    <a class="dropdown-item waves-light waves-effect" id="emailDebitNote" href="javascript:void(0);">Email Debit Note</a>
                    <a class="dropdown-item waves-light waves-effect" id="approveDebitNote" href="javascript:void(0);">Approve</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item waves-light waves-effect" href="#">Discard Debit Note</a>
                    <a class="dropdown-item waves-light waves-effect" href="#">Edit Debit Note</a>
                </div>
            </div>
            <a href="{{url('/policy/credit-note/new/'.$debit->slug) }}" class="btn btn-success btn-print-invoice m-b-10 btn-mini waves-effect waves-light m-r-20"><i class="ti-check mr-2"></i>Raise Credit Note</a>

        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
<script src="/assets/js/printThis.js"></script>
<script>
    $(document).ready(function(){
        //print without commission
        $(document).on('click', '#withCommission', function(event){
            $('.commission').show();
            $('#printArea').printThis();
        });
        $(document).on('click', '#withoutCommission', function(event){
            $('.commission').hide();
           // $('.net_amount').hide();
            //$('.vat_handle').hide();
            $('#printArea').printThis();
        });
    });
</script>
@endsection
