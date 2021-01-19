@extends('layouts.master')

@section('title')
    Account Settings
@endsection
@section('current-page')
    Account Settings
@endsection
@section('current-page-brief')
    Account Settings
@endsection
@section('extra-styles')
<link href="/assets/css/select2.min.css" rel="stylesheet" />
@endsection
@section('main-content')
<div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card">
            <div class="card-block">
                <div class="col-lg-12 col-xl-12">
                    <div class="sub-title">Account Settings</div>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs  tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#accounts" role="tab">Accounts & Transaction Defaults</a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content tabs card-block">
                        <div class="tab-pane active" id="accounts" role="tabpanel">
                            <h5 class="sub-title text-primary">Accounts & Transaction Defaults</h5>
                            @if (session()->has('success'))
                                <div class="alert alert-success background-success">
                                    {!! session()->get('success') !!}
                                </div>
                            @endif
                            <form action="{{url('accounting/account-settings')}}" method="POST">
                                @csrf
                                <div class="card-block table-border-style">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Transaction</th>
                                                    <th>DR</th>
                                                    <th>CR</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($settings as $setting)
                                                    <tr>
                                                        <td>Account for {{ucfirst(str_replace('-', ' ',$setting->transaction))}}
                                                            <input type="hidden" name="transaction[]" value="{{$setting->transaction}}">
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <select name="debit[]"  class="form-control js-example-basic-single">
                                                                    <option disabled selected>Select account</option>
                                                                    @foreach ($accounts as $account)
                                                                        <option value="{{$account->glcode}}">{{$account->account_name ?? ''}} - ({{$account->glcode}})</option>
                                                                    @endforeach
                                                                </select> <br>
                                                                <small class="text-muted"><label for="" class="label label-info">Previous selection: </label>
                                                                        <i>{{ $setting->getDebit->account_name.' - '.$setting->getDebit->glcode ?? 'No account assigned yet'}}</i>
                                                                </small>
                                                                <br>
                                                                @error('debit_note_dr')
                                                                    <i class="text-danger mt-2">{{$message}}</i>
                                                                @enderror
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <select name="credit[]"  class="form-control js-example-basic-single">
                                                                    <option disabled selected>Select account</option>
                                                                    @foreach ($accounts as $account)
                                                                        <option value="{{$account->glcode}}">{{$account->account_name ?? ''}} - ({{$account->glcode}})</option>
                                                                    @endforeach
                                                                </select> <br>
                                                                <small class="text-muted"><label for="" class="label label-info">Previous selection: </label>
                                                                    <i>{{ $setting->getCredit->account_name.' - '.$setting->getCredit->glcode ?? 'No account assigned yet'}}</i>
                                                                </small>
                                                                <br>
                                                                @error('debit_note_cr')
                                                                    <i class="text-danger mt-2">{{$message}}</i>
                                                                @enderror
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="btn-group d-flex justify-content-center">
                                            <a href="" class="btn btn-mini btn-danger"><i class="ti-close mr-2"></i> Cancel</a>
                                            <button class="btn btn-mini btn-primary" type="submit"><i class="ti-check mr-2"></i>Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('dialog-section')

@endsection

@section('extra-scripts')
<script src="/assets/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.js-example-basic-single').select2();
    });
</script>
@endsection
