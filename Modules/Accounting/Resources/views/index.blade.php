@extends('layouts.master')

@section('title')
    Chart of Accounts
@endsection
@section('current-page')
    Chart of Accounts
@endsection
@section('current-page-brief')
    Chart of Accounts
@endsection
@section('main-content')
<div class="row">
    <div class="col-xl-12 col-lg-12  filter-bar">
        <nav class="navbar navbar-light bg-faded m-b-30 p-10">
            <div class="nav-item nav-grid">
                <a href="{{ route('create-chart-of-account') }}" class="btn btn-primary btn-mini waves-effect waves-light"><i class="ti-plus mr-2"></i>Add New Chart of Account</a>
            </div>
        </nav>
    </div>
</div>

<div class="row ">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header mb-4">
                <h5 class="card-header-text text-uppercase">Chart of Accounts</h5></div>
            <div class="card-block accordion-block">
                <div class="col-xs-12 col-sm-12 mb-4 ">
                    @if(count($charts) > 0)
                        <table id="complex-header" class="table table-striped table-bordered nowrap dataTable" id="chartOfAccountsTable" role="grid" aria-describedby="complex-header_info" style="width: 100%; margin:0px auto;">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc text-left" tabindex="0" style="width: 50px;">S/No.</th>
                                <th class="sorting_asc text-left" tabindex="0" style="width: 50px;">ACCOUNT CODE</th>
                                <th class="sorting_asc text-left" tabindex="0" style="width: 150px;">ACCOUNT NAME</th>
                                <th class="sorting_asc text-left" tabindex="0" >PARENT</th>
                                <th class="sorting_asc text-left" tabindex="0" >TYPE</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $a = 1;
                            @endphp
                            <tr role="row" class="odd">
                                <td class="sorting_1" colspan="5"><strong style="font-size:16px; text-transform:uppercase;">Assets</strong></td>
                            </tr>
                            @foreach($charts as $report)
                                @switch($report->account_type)
                                    @case(1)
                                    @if ($report->glcode != 1)
                                        <tr role="row" class="odd {{ $report->type == 0 ? 'bg-secondary text-white' : '' }}">
                                            <td class="text-left">{{$a++}}</td>
                                            <td class="sorting_1 text-left">{{$report->glcode ?? ''}}</td>
                                            <td class="text-left">{{$report->account_name ?? ''}}</td>
                                            <td class="text-left">{{$report->parent_account ?? ''}} - {{$report->getParentAccountById($report->coa_id)->account_name ?? '' }}</td>
                                            <td class="text-left">{{$report->type == 0 ? 'General' : 'Detail'}}</td>
                                        </tr>
                                    @endif
                                    @break
                                @endswitch
                            @endforeach

                            <tr role="row" class="odd">
                                <td class="sorting_1"  colspan="5">
                                    <strong style="font-size:16px; text-transform:uppercase;">Liability</strong>
                                </td>
                            </tr>
                            @foreach($charts as $report)
                                @switch($report->account_type)
                                    @case(2)
                                    @if ($report->glcode != 2)
                                        <tr role="row" class="odd {{ $report->type == 0 ? 'bg-secondary text-white' : '' }}">
                                            <td class="text-left">{{$a++}}</td>
                                            <td class="sorting_1 text-left">{{$report->glcode ?? ''}}</td>
                                            <td class="text-left">{{$report->account_name ?? ''}}</td>
                                            <td class="text-left">{{$report->parent_account ?? ''}} - {{$report->getParentAccountById($report->coa_id)->account_name ?? '' }}</td>
                                            <td class="text-left">{{$report->type == 0 ? 'General' : 'Detail'}}</td>
                                        </tr>

                                    @endif
                                    @break
                                @endswitch
                            @endforeach
                            <tr role="row" class="odd">
                                <td class="sorting_1"  colspan="5"><strong style="font-size:16px; text-transform:uppercase;">Equity</strong></td>
                            </tr>
                            @foreach($charts as $report)
                                @switch($report->account_type)
                                    @case(3)
                                    @if ($report->glcode != 3)
                                        <tr role="row" class="odd {{ $report->type == 0 ? 'bg-secondary text-white' : '' }}">
                                            <td class="text-left">{{$a++}}</td>
                                            <td class="sorting_1 text-left">{{$report->glcode ?? ''}}</td>
                                            <td class="text-left">{{$report->account_name ?? ''}}</td>
                                            <td class="text-left">{{$report->parent_account ?? ''}} - {{$report->getParentAccountById($report->coa_id)->account_name ?? '' }}</td>
                                            <td class="text-left">{{$report->type == 0 ? 'General' : 'Detail'}}</td>
                                        </tr>

                                    @endif
                                    @break
                                @endswitch
                            @endforeach
                            <tr role="row" class="odd">
                                <td class="sorting_1"  colspan="5"><strong style="font-size:16px; text-transform:uppercase;">Revenue</strong></td>
                            </tr>
                            @foreach($charts as $report)
                                @switch($report->account_type)
                                    @case(4)
                                    @if ($report->glcode != 4)
                                        <tr role="row" class="odd {{ $report->type == 0 ? 'bg-secondary text-white' : '' }}">
                                            <td class="text-left">{{$a++}}</td>
                                            <td class="sorting_1 text-left">{{$report->glcode ?? ''}}</td>
                                            <td class="text-left">{{$report->account_name ?? ''}}</td>
                                            <td class="text-left">{{$report->parent_account ?? ''}} - {{$report->getParentAccountById($report->coa_id)->account_name ?? '' }}</td>
                                            <td class="text-left">{{$report->type == 0 ? 'General' : 'Detail'}}</td>
                                        </tr>

                                    @endif
                                    @break
                                @endswitch
                            @endforeach
                            <tr role="row" class="odd">
                                <td class="sorting_1"  colspan="5"><strong style="font-size:16px; text-transform:uppercase;">Expenses</strong></td>
                            </tr>
                            @foreach($charts as $report)
                                @switch($report->account_type)
                                    @case(5)
                                    @if ($report->glcode != 5)
                                        <tr role="row" class="odd {{ $report->type == 0 ? 'bg-secondary text-white' : '' }}">
                                            <td class="text-left">{{$a++}}</td>
                                            <td class="sorting_1 text-left">{{$report->glcode ?? ''}}</td>
                                            <td class="text-left">{{$report->account_name ?? ''}}</td>
                                            <td class="text-left">{{$report->parent_account ?? ''}} - {{$report->getParentAccountById($report->coa_id)->account_name ?? '' }}</td>
                                            <td class="text-left">{{$report->type == 0 ? 'General' : 'Detail'}}</td>
                                        </tr>

                            @endif
                            @break
                            @endswitch
                            @endforeach
                        </table>
                    @else
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-center">
                                <a href="{{route('create-major-transaction-accounts')}}" class="btn btn-primary">Create The Default 5 Accounts</a> <br>
                            </div>
                            <div class="col-md-12 d-flex justify-content-center">
                                <p>
                                    <strong>Note: </strong>
                                    This covers Assets, Liability, Equity, Revenue & Expenses.
                                </p>
                            </div>

                        </div>

                    @endif
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
    <script>
         $(document).ready(function(){
            $('#gl_code_error').hide();
            $('#account_type_error').hide();
            $('#addNewAccountBtn').prop("disabled", true);
            $("#gl_code").blur(function () {
                var gl_code = $(this).val();
                gl_code = String(gl_code);
                var length  = gl_code.length;
                if(length%2 == 0){
                    $('#gl_code_error').show();
                    $('#gl_code_error').html("Length of account number should be odd");
                    $('#addNewAccountBtn').prop("disabled", true);
                }
                else{
                    $('#gl_code_error').hide();
                    $('#addNewAccountBtn').prop("disabled", false);
                    //console.log("Number @ :"+$(this).val().toString().charAt(0));
                }

            });
            //Account type
            $(document).on('change', '#account_type', function(e){
                e.preventDefault();
                var account_type = $(this).val();
                console.log(account_type);
                switch (account_type) {
                    case "1":
                       if($('#gl_code').val().toString().charAt(0) != 1){
                            $('#account_type_error').show();
                            $("#account_type_error").html("Invalid GL code for this account type. Hint: First number should start with <strong>1</strong>");
                            $('#addNewAccountBtn').prop("disabled", true);
                        }else{
                            $('#account_type_error').hide();
                            $('#addNewAccountBtn').prop("disabled", false);
                           getParentAccount(1, $('#type').val() );
                        }
                    break;
                    case "2":
                        if($('#gl_code').val().toString().charAt(0) != 2){
                            $('#account_type_error').show();
                            $("#account_type_error").html("Invalid GL code for this account type. Hint: First number should start with <strong>2</strong>");
                            $('#addNewAccountBtn').prop("disabled", true);
                        }else{
                            $('#account_type_error').hide();
                            $('#addNewAccountBtn').prop("disabled", false);
                            getParentAccount(2, $('#type').val() );
                        }
                    break;
                    case "3":
                        if($('#gl_code').val().toString().charAt(0) != 3){
                            $('#account_type_error').show();
                            $("#account_type_error").html("Invalid GL code for this account type. Hint: First number should start with <strong>3</strong>");
                            $('#addNewAccountBtn').prop("disabled", true);
                        }else{
                            $('#account_type_error').hide();
                            $('#addNewAccountBtn').prop("disabled", false);
                            getParentAccount(3, $('#type').val() );
                        }
                    break;
                    case "4":
                        if($('#gl_code').val().toString().charAt(0) != 4){
                            $('#account_type_error').show();
                            $("#account_type_error").html("Invalid GL code for this account type. Hint: First number should start with <strong>4</strong>");
                            $('#addNewAccountBtn').prop("disabled", true);
                        }else{
                            $('#account_type_error').hide();
                            $('#addNewAccountBtn').prop("disabled", false);
                            getParentAccount(4, $('#type').val() );
                        }
                    break;
                    case "5":
                        if($('#gl_code').val().toString().charAt(0) != 5){
                            $('#account_type_error').show();
                            $("#account_type_error").html("Invalid GL code for this account type. Hint: First number should start with <strong>5</strong>");
                            $('#addNewAccountBtn').prop("disabled", true);
                        }else{
                            $('#account_type_error').hide();
                            $('#addNewAccountBtn').prop("disabled", false);
                            getParentAccount(5, $('#type').val() );
                        }
                    break;


                }
            });
            //type
            $(document).on('change', '#type', function(e){
                e.preventDefault();
                getParentAccount($('#account_type').val(), $('#type').val() );
                /*axios.post('/get-parent-account', {account_type:$(this).val()})
                .then(response=>{
                    $.each(response.data.parents, function (index, value) {
                        $('#parent_account').append('<option value="' + value.id + '">' + value.account_name + '</option>');
                    });
                });*/
            });

            $(document).on('click', '#addNewAccountBtn',function(e){
                e.preventDefault();
                axios.post('/accounting/save-account', {
                    'glcode':$('#gl_code').val(),
                    'account_name':$('#account_name').val(),
                    'account_type':$('#account_type').val(),
                    'type':$('#type').val(),
                    'bank':$('#bank').val(),
                    'parent_account':$('#parent_account').val()
                })
                .then(response=>{
                    $('#addNewAccountModal').modal('hide');
                    Toastify({
                        text: "Success! New account saved.",
                        duration: 3000,
                        newWindow: true,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                        stopOnFocus: true,
                        onClick: function(){}
                        }).showToast();
                        $("#chartOfAccountsTable").load(location.href + " #chartOfAccountsTable");
                });
            });
        });

        function getParentAccount(account_type, type){

            axios.post('/accounting/get-parent-account', {account_type:account_type, type:type})
            .then(response=>{
                $('#parentAccountWrapper').html(response.data);
                /* $.each(response.data.parents, function (index, value) {
                    $('#parent_account').append('<option value="' + value.glcode + '">' + value.account_name +" - "+ value.glcode + '</option>');
                }); */
            });
        }
    </script>
@endsection
