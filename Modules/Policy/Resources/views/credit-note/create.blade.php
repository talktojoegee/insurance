@extends('layouts.master')

@section('title')
    Raise New Credit Note
@endsection

@section('extra-styles')
    <style type="text/css">
        .label{
            padding: 1px 4px !important;
        }
    </style>
@endsection
@section('current-page')
    Raise New Credit Note
@endsection
@section('current-page-brief')
    Create a new credit note
@endsection
@section('main-content')

@include('policy::partials._policy-shortcut')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-block">
                <h5 class="sub-title">Raise New Credit Note</h5>
                <h5 class="mb-3 sub-title text-primary"><strong>1.</strong> Policy Documentation</h5>
                @if(session()->has('success'))
                    <div class="alert alert-success background-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="icofont icofont-close-line-circled text-white"></i>
                        </button>
                        {!!  session()->get('success') !!}
                    </div>
                @endif
                <form action="{{url('/policy/credit-note/new')}}" method="post" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12">
                            <div class="form-group">
                                <label for="">Credit Code Number</label>
                                <input type="text" readonly  value="{{$creditCode}}" class="form-control" placeholder="Credit Code">
                                <input type="hidden" name="credit_code" value="{{$creditCode}}" class="form-control" placeholder="Credit Code">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12">
                            <div class="form-group">
                                <label>Client Number</label>
                                <input class="form-control" readonly  placeholder="Client Number" name="client_number" id="client_number" value="{{$debit->getBusinessClass->abbr}}/{{date('m',strtotime($debit->created_at))}}/{{date('y', strtotime($debit->created_at))}}/{{$debit->policy_no}}">
                                <input type="hidden" name="client" value="{{$debit->client_id ?? ''}}">
                                @error('client_number')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                            </div>
                            <input type="hidden" name="business_class" value="{{$debit->getBusinessClass->id}}">
                            <input type="hidden" name="sub_business_class" value="{{$debit->getSubBusinessClass->id}}">
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12">
                            <div class="form-group">
                                <label>Debit Code Number</label>
                                <input class="form-control" value=" {{$debit->debit_code }}" readonly placeholder="Debit Code Number" name="debit_code_number" id="debit_code_number">
                                @error('debit_code_number')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                                <input type="hidden" name="policy" value="{{$debit->policy_no}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12">
                            <div class="form-group">
                                <label>Insurance Period <small class="label label-inverse-info">({{  !is_null($debit->end_date) ? \Carbon\Carbon::parse($debit->end_date)->diffInDays(\Carbon\Carbon::parse($debit->start_date)) : '-' }} days)</small></label>
                                <div class="input-group input-group-button">
                                    <span class="input-group-addon btn btn-primary">
                                        <span class="">Start Date</span>
                                    </span>
                                    <input type="text" readonly value=" {{!is_null($debit->start_date) ? date('d F, Y', strtotime($debit->start_date)) : '' }}" class="form-control" placeholder="Start Date" name="start_date" id="start_date">
                                    <span class="input-group-addon btn btn-primary" >
                                        <span class="">End Date</span>
                                    </span>
                                    <input type="text" readonly value="{{!is_null($debit->end_date) ? date('d F, Y', strtotime($debit->end_date)) : '' }}" class="form-control" placeholder="End Date" name="end_date" id="end_date">
                                </div>

                                @error('insurance_period')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-3 col-sm-4">
                            <div class="form-group">
                                <label>Business Class</label>
                                <input type="text" class="form-control" readonly id="business_class" value=" {{$debit->getBusinessClass->class_name ?? '' }}">
                            </div>
                                @error('business_class')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-3 col-sm-4">
                            <div class="form-group">
                                <label>Sub-business Class</label>
                                <input type="text" class="form-control"  readonly id="sub_business_class" value=" {{$debit->getSubBusinessClass->class_name ?? '' }}">
                            </div>
                                @error('sub_business_class')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                                <input type="hidden" name="business_class" value="{{$debit->class_id}}">
                                <input type="hidden" name="sub_business_class" value="{{$debit->sub_class_id}}">
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-3 col-sm-4">
                            <div class="form-group">
                                <label>Business Type</label>
                                <select class="form-control" value=" {{old('business_type') }}" name="business_type" id="business_type">
                                    <option selected disabled >Select business type</option>
                                    <option value="1">New</option>
                                    <option value="2">Additional</option>
                                    <option value="3">Renewal</option>
                                    <option value="4">Return</option>
                                    <option value="5">Reversal</option>
                                </select>
                                @error('business_type')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-3 col-sm-4">
                            <div class="form-group">
                                <label>Option</label>
                                <select class="form-control" value=" {{old('option') }}" name="option" id="option">
                                    <option selected disabled >Select option type</option>
                                    <option value="1">Direct</option>
                                    <option value="2">Co-broking</option>
                                    <option value="3">Lead-broking</option>
                                    <option value="4">Outward Reinsurance</option>
                                    <option value="5">Inward Reinsurance</option>
                                </select>
                                @error('option')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-sm-4">
                            <div class="form-group">
                                <label>Insurance Company</label>
                                <input type="text" class="form-control" readonly value=" {{$debit->getAgency->agent_name ?? '' }}">
                            </div>
                                @error('agent')
                                    <i class="text-danger mt-5">{{ $message }}</i>
                                @enderror
                            <input type="hidden" name="agent" value="{{$debit->agency_id}}">
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12">
                            <div class="form-group">
                                <label>Insured Name</label>
                                <input class="form-control" type="text" readonly value=" {{$debit->getClient->insured_name ?? '' }}" placeholder="Insured Name" name="insured_name" id="insured_name">
                                @error('insured_name')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                        <input type="hidden" name="policy_number" value="{{$debit->policy_no}}">
                        <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input class="form-control" type="email" readonly value=" {{$debit->getClient->email ?? '' }}" placeholder="Email Address" name="email_address" id="email_address">
                                @error('email_address')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12">
                            <div class="form-group">
                                <label>Mobile No.</label>
                                <input class="form-control" readonly type="text" value=" {{$debit->getClient->mobile_no ?? '' }}" placeholder="Mobile No." name="mobile_no" id="mobile_no">
                                @error('mobile_no')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6">
                            <div class="form-group">
                                <label>Office/Residential Address</label>
                                <textarea placeholder="Office/Residential Address" readonly name="address" id="address" class="form-control" style="resize: none;">{{ $debit->getClient->address ?? '' }}</textarea>
                                @error('address')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <h5 class="mb-3 sub-title text-primary"><strong>2.</strong> Payment Information</h5>
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xl-6 col-sm-6">
                           <div class="form-group">
                                <label>Sum Insured <small class="label label-inverse-info">({{$debit->getCurrency->symbol ?? ''}} {{number_format($debit->sum_insured,2) }})</small></label>
                                <input class="form-control" readonly type="number" step="0.01" value="{{$debit->sum_insured }}" placeholder="Sum Insured" name="sum_insured" id="sum_insured">
                                @error('sum_insured')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-3 col-sm-6">
                            <div class="form-group">
                                <label>Currency</label>
                                <select class="form-control" value=" {{old('currency') }}" name="currency" id="currency">
                                    <option selected disabled >Select currency</option>
                                    @foreach ($currencies as $item)
                                        <option value="{{$item->id}}">{{$item->name ?? ''}} - ({{$item->symbol ?? ''}})</option>
                                    @endforeach
                                </select>
                                @error('currency')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-3 col-sm-6">
                            <div class="form-group">
                                <label>Exchange Rate</label>
                                <input type="number" step="0.01" class="form-control" value="{{old('exchange_rate', 1) }}" name="exchange_rate" id="exchange_rate">
                                @error('exchange_rate')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xl-6 col-sm-6">
                           <div class="form-group">
                                <label>Premium Rate <small class="label label-inverse-info">( {{$debit->getCurrency->symbol ?? ''}}{{$debit->premium_rate }}%)</small></label>
                                <input class="form-control" readonly type="number" step="0.01" value="{{$debit->premium_rate }}" placeholder="Premium Rate"name="premium_rate" id="premium_rate">
                                @error('sum_insured')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-sm-6">
                           <div class="form-group">
                                <label>Gross Premium <small class="label label-inverse-info">({{$debit->getCurrency->symbol ?? ''}} {{number_format($debit->gross_premium,2) }})</small></label>
                                <input class="form-control "  type="number" readonly step="0.01" value="{{$debit->gross_premium }}" readonly placeholder="Gross Premium" name="gross_premium" id="gross_premium">
                                @error('gross_premium')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xl-6 col-sm-6">
                           <div class="form-group">
                                <label>Commission Rate</label>
                                <input class="form-control" type="number" step="0.01" value="{{old('commission_rate') }}" placeholder="Commission Rate"name="commission_rate" id="commission_rate">
                                @error('commission_rate')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-sm-6">
                           <div class="form-group">
                                <label>Commission </label>
                                <input class="form-control "  type="number" step="0.01" value="{{old('commission') }}" readonly placeholder="Commission" name="commission" id="commission">
                                @error('commission')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xl-6 col-sm-6">
                           <div class="form-group">
                                <label>Net Amount</label>
                                <input class="form-control" readonly type="number" step="0.01" value="{{old('net_amount') }}" placeholder="Net Amount"name="net_amount" id="net_amount">
                                @error('net_amount')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-sm-6">
                           <div class="form-group">
                                <label>Payment Mode</label>
                                <select class="form-control"  name="payment_mode" id="payment_mode">
                                    <option selected disabled >Select payment mode</option>
                                    <option value="1">Cash</option>
                                    <option value="2">Bank Transfer</option>
                                    <option value="3">Cheque</option>
                                    <option value="4">To be advised</option>
                                </select>
                                @error('payment_mode')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                            </div>
                            <input name="vatValue" id="vatValue" type="hidden" >
                            <input name="vatChecked" id="vatChecked" type="hidden" value="0">
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-sm-6">
                           <div class="checkbox-fade fade-in-primary mt-4">
                                <label>
                                    <input name="vat" id="vat" type="checkbox" value="7.5">
                                    <span class="cr">
                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                    </span>
                                    <span>Include VAT</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12 d-flex justify-content-center">
                            <div class="btn-group">
                                <a class="btn btn-danger btn-mini" href=""><i class="ti-close mr-2"></i> Cancel</a>
                                <button type="submit" class="btn btn-primary btn-mini"><i class="ti-check mr-2"></i> Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('extra-scripts')
<script src="/assets/js/axios.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

         $(document).on('blur', '#commission_rate', function(e){
            e.preventDefault();
            var commission = parseFloat($(this).val()/100) * parseFloat($('#gross_premium').val());
            $('#commission').val(commission);
            $('#net_amount').val(parseFloat($('#gross_premium').val()) + commission);
        });
        //(this.debit.gross_premium - (this.vat/100 * this.debit.commission) - this.debit.commission);
        $(document).on('change', '#vat', function(e){
            let commission = parseFloat($('#commission_rate').val()/100) * parseFloat($('#gross_premium').val());
            if($(this).is(':checked')){
                let vat = ( parseFloat( $(this).val()  ) /100) * commission;
                $('#vatValue').val(vat);
               $('#vatChecked').val(1);
                parseFloat($('#net_amount').val(parseFloat($('#gross_premium').val()) + (vat + commission))).toFixed(2);
            }else{
                $('#vatChecked').val(0);
                parseFloat($('#net_amount').val(parseFloat($('#gross_premium').val()) + commission)).toFixed(2);
            }
        });
    });
</script>
@endsection
