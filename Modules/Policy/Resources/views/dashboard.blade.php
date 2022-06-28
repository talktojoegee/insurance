@extends('layouts.master')

@section('title')
    Dashboard
@endsection

@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="\bower_components\chartist\css\chartist.css">
@endsection
@section('main-content')


    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card user-widget-card bg-c-blue">
                <div class="card-block">
                    <i class="icofont icofont-presentation-alt  bg-simple-c-blue card1-icon"></i>
                    <h4>{{ number_format($policies->where('policy_type',1)->count() ) }}</h4>
                    <p>Non-Motor Policies</p>
                    <a href="#!" class="more-info">More Info</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card user-widget-card bg-c-pink">
                <div class="card-block">
                    <i class="icofont icofont-car-alt-4 bg-simple-c-pink card1-icon"></i>
                    <h4>{{ number_format($policies->where('policy_type',2)->count() ) }}</h4>
                    <p>Motor Policies</p>
                    <a href="#!" class="more-info">More Info</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card user-widget-card bg-c-green">
                <div class="card-block">
                    <i class="icofont icofont-ui-v-card bg-simple-c-green card1-icon"></i>
                    <h4>{{ number_format($debitNotes->count() ) }}</h4>
                    <p>Debit Notes</p>
                    <a href="#!" class="more-info">More Info</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card user-widget-card bg-c-yellow">
                <div class="card-block">
                    <i class="icofont icofont-ui-fire-wall bg-simple-c-yellow card1-icon"></i>
                    <h4>{{ number_format($creditNotes->count() ) }}</h4>
                    <p>Credit Notes</p>
                    <a href="#!" class="more-info">More Info</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-block">
                    <h5 class="sub-title">Recent Policies</h5>
                    <div class="card-block">
                        <div class="dt-responsive table-responsive">
                            <table id="businessTable" class="portableTables table table-striped table-bordered nowrap">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Client No.</th>
                                    <th>Insured</th>
                                    <th>Insurance Policy No.</th>
                                    <th>Sum Insured</th>
                                    <th>Gross Premium</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $serial = 1;
                                @endphp
                                @foreach($policies->take(7) as $policy)
                                    <tr>
                                        <td>{{ $serial++ }}</td>
                                        <td>{{$policy->getBusinessClass->abbr}}/{{date('m',strtotime($policy->created_at))}}/{{date('y', strtotime($policy->created_at))}}/{{$policy->policy_number}}</td>
                                        <td> <a href="{{ url('/policy/client/view/'.$policy->getClient->slug) }}"> {{ $policy->getClient->insured_name ?? '' }}</a></td>
                                        <td>{{ $policy->insurance_policy_number ?? '' }}</td>
                                        <td class="text-right">{{$policy->getCurrency->symbol ?? ''}}{{ number_format($policy->sum_insured/$policy->exchange_rate,2) }}</td>
                                        <td class="text-right">{{$policy->getCurrency->symbol ?? ''}}{{ number_format($policy->gross_premium/$policy->exchange_rate,2) ?? '' }}</td>
                                        <td class="text-success">{{ !is_null($policy->start_date) ? date('d F, Y', strtotime($policy->start_date)) : '' }}</td>
                                        <td class="text-danger">{{ !is_null($policy->end_date) ? date('d F, Y', strtotime($policy->end_date)) : '' }}</td>
                                        <td>
                                            <a href="{{ url('/policy/view/policy/'.$policy->slug) }}" class="btn btn-mini btn-primary">Learn more</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Client No.</th>
                                    <th>Insured</th>
                                    <th>Insurance Policy No.</th>
                                    <th>Sum Insured</th>
                                    <th>Gross Premium</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-block">
                    <h5 class="sub-title">Summary Chart <span class="badge badge-danger">({{date('Y')}})</span></h5>
                    <div class="card-block">
                        <canvas id="barChart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-header-text">Debit Note vs Credit Note</h5>
                </div>
                <div class="card-block accordion-block">
                    <div class="accordion-box ui-accordion ui-widget ui-helper-reset" id="single-open" role="tablist">
                        <a class="accordion-msg scale_active ui-accordion-header ui-corner-top ui-state-default ui-accordion-header-active ui-state-active ui-accordion-icons" role="tab" id="ui-id-1" aria-controls="ui-id-2" aria-selected="true" aria-expanded="true" tabindex="0">
                            <span class="ui-accordion-header-icon ui-icon zmdi zmdi-chevron-up text-danger"></span><label for="" class="badge-danger badge mr-3">1</label>Recent Debit Notes</a>
                        <div class="accordion-desc ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content ui-accordion-content-active" style="" id="ui-id-2" aria-labelledby="ui-id-1" role="tabpanel" aria-hidden="false">
                            <div class="dt-responsive table-responsive">
                                <table id="businessTable" class="portableTables table table-striped table-bordered nowrap">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Debit Code</th>
                                        <th>Client No.</th>
                                        <th>Insured</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Agency</th>

                                        <th>Option</th>
                                        <th>Business Type</th>
                                        <th>Business Class</th>
                                        <th>Sub Class</th>
                                        <th>Currency</th>
                                        <th>Sum Insured</th>
                                        <th>Premium Rate</th>
                                        <th>Gross Premium</th>
                                        <th>Commission Rate</th>
                                        <th>Commission</th>

                                        <th>VAT Rate</th>
                                        <th>VAT</th>
                                        <th>Exchange Rate</th>
                                        <th>Net Amount</th>

                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $index = 1;
                                    @endphp
                                    @if(count($debitNotes) > 0)
                                        @foreach($debitNotes->take(5) as $lst)
                                            <tr>
                                                <td>{{$index++}}</td>
                                                <td>{{$lst->debit_code}}</td>
                                                <td> {{$lst->getPolicy->getBusinessClass->abbr}}/{{date('m',strtotime($lst->getPolicy->getBusinessClass->created_at))}}/{{date('y',strtotime($lst->getPolicy->getBusinessClass->created_at))}}/{{$lst->getPolicy->policy_number}}
                                                </td>
                                                <td>{{$lst->getClient->insured_name ?? ''}}</td>

                                                <td>{{date('d M, Y', strtotime($lst->start_date))}}</td>
                                                <td class="text-danger">{{date('d M, Y', strtotime($lst->end_date))}}</td>
                                                <td>{{$lst->getAgency->agent_name ?? ''}}</td>
                                                @if($lst->option == 1)
                                                    <td>Direct</td>
                                                @elseif($lst->option == 2)
                                                    <td>Co-broking</td>
                                                @elseif($lst->option == 3)
                                                    <td>Lead-broking</td>
                                                @elseif($lst->option == 4)
                                                    <td>Outward Reinsurance</td>
                                                @elseif($lst->option == 5)
                                                    <td>Inward Reinsurance</td>
                                                @endif
                                            <!--/ Option -->

                                                @if($lst->business_type == 1)
                                                    <td>New</td>
                                                @elseif($lst->business_type == 2)
                                                    <td>Additional</td>
                                                @elseif($lst->business_type == 3)
                                                    <td>Renewal</td>
                                                @elseif($lst->business_type == 4)
                                                    <td>Return</td>
                                                @elseif($lst->business_type == 5)
                                                    <td>Reversal</td>
                                                @endif

                                                <td>{{$lst->getPolicy->getBusinessClass->class_name ?? ''}}</td>
                                                <td>{{$lst->getPolicy->getSubBusinessClass->class_name ?? ''}}</td>
                                                <td>{{$lst->getCurrency->name ?? ''}}({{$lst->getCurrency->symbol ?? ''}})</td>
                                                <td class="text-right">{{$lst->getCurrency->symbol ?? ''}}{{ number_format($lst->sum_insured,2)}}
                                                </td>
                                                <td>{{$lst->premium_rate}}%</td>
                                                <td class="text-right">{{$lst->getCurrency->symbol ?? ''}}{{number_format($lst->gross_premium,2)}}
                                                </td>
                                                <td>{{$lst->commission_rate}}%</td>
                                                <td class="text-right">{{$lst->getCurrency->symbol ?? ''}}{{number_format($lst->commission,2)}}
                                                </td>
                                                <td>{{$lst->vat_rate ?? '-' }}%</td>
                                                <td class="text-right">{{$lst->getCurrency->symbol ?? ''}}{{number_format(($lst->vat_rate/100)*$lst->commission ?? 0,2)}}</td>
                                                <td>{{$lst->currency ?? ''}}</td>
                                                <td class="text-right">{{$lst->getCurrency->symbol ?? ''}}{{number_format($lst->net_amount,2)}}
                                                </td>
                                                @if($lst->status == 0)
                                                    <td><label for="" class="badge badge-warning text-white">Pending</label></td>
                                                @else
                                                    <td><label for="" class="badge badge-success text-white">Approved</label>
                                                    </td>
                                                @endif
                                                <td>
                                                    <div class="btn-group">
                                                        <a class="text-primary" href="/policy/debit-note/view/{{$lst->slug}}" class="btn btn-primary btn-mini" > Learn more

                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <h2>No record found</h2>
                                    @endif
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Debit Code</th>
                                        <th>Client No.</th>
                                        <th>Insured</th>

                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Agency</th>
                                        <th>Option</th>
                                        <th>Business Type</th>
                                        <th>Business Class</th>
                                        <th>Sub Class</th>
                                        <th>Currency</th>
                                        <th>Sum Insured</th>
                                        <th>Premium Rate</th>
                                        <th>Gross Premium</th>
                                        <th>Commission Rate</th>
                                        <th>Commission</th>
                                        <th>VAT Rate</th>
                                        <th>VAT</th>
                                        <th>Exchange Rate</th>
                                        <th>Net Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <a class="accordion-msg scale_active ui-accordion-header ui-corner-top ui-accordion-header-collapsed ui-corner-all ui-state-default ui-accordion-icons" role="tab" id="ui-id-3" aria-controls="ui-id-4" aria-selected="false" aria-expanded="false" tabindex="-1">
                            <span class="ui-accordion-header-icon ui-icon zmdi zmdi-chevron-down text-info"></span>
                            <label for="" class="badge-danger badge mr-3">2</label> Recent Credit Note</a>
                        <div class="accordion-desc ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content" style="display: none;" id="ui-id-4" aria-labelledby="ui-id-3" role="tabpanel" aria-hidden="true">
                            <div class="dt-responsive table-responsive">
                                <table id="businessTable" class="portableTables table table-striped table-bordered nowrap">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Credit Code</th>
                                        <th>Client No.</th>
                                        <th>Insured</th>
                                        <th>Cover Days</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Insurance Company.</th>
                                        <th>Option</th>
                                        <th>Business Type</th>
                                        <th>Business Class</th>
                                        <th>Sub Class</th>
                                        <th>Currency</th>
                                        <th>Sum Insured</th>
                                        <th>Premium Rate</th>
                                        <th>Gross Premium</th>
                                        <th>Commission Rate</th>
                                        <th>Commission</th>
                                        <th>VAT Rate</th>
                                        <th>VAT</th>
                                        <th>Exchange Rate</th>
                                        <th>Net Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $index = 1;
                                    @endphp
                                    @if(count($creditNotes) > 0)
                                        @foreach($creditNotes->take(5) as $lst)
                                            <tr>
                                                <td>{{$index++}}</td>
                                                <td>{{$lst->credit_code}}</td>
                                                <td> {{$lst->getPolicy->getBusinessClass->abbr}}/{{date('m',strtotime($lst->getPolicy->getBusinessClass->created_at))}}/{{date('y',strtotime($lst->getPolicy->getBusinessClass->created_at))}}/{{$lst->getPolicy->policy_number}}
                                                </td>
                                                <td>{{$lst->getClient->insured_name ?? ''}}</td>
                                                <td>{{$lst->cover_days ?? '-'}}</td>
                                                <td>{{ !is_null($lst->start_date) ? date('d M, Y', strtotime($lst->start_date)) : 'Unknown'}}</td>
                                                <td>{{ !is_null($lst->end_date) ? date('d M, Y', strtotime($lst->end_date)) : 'Unknown'}}</td>
                                                <td>{{$lst->getClient->insured_name ?? ''}}</td>
                                                @if($lst->option == 1)
                                                    <td>Direct</td>
                                                @elseif($lst->option == 2)
                                                    <td>Co-broking</td>
                                                @elseif($lst->option == 3)
                                                    <td>Lead-broking</td>
                                                @elseif($lst->option == 4)
                                                    <td>Outward Reinsurance</td>
                                                @elseif($lst->option == 5)
                                                    <td>Inward Reinsurance</td>
                                                @endif
                                            <!--/ Option -->

                                                @if($lst->business_type == 1)
                                                    <td>New</td>
                                                @elseif($lst->business_type == 2)
                                                    <td>Additional</td>
                                                @elseif($lst->business_type == 3)
                                                    <td>Renewal</td>
                                                @elseif($lst->business_type == 4)
                                                    <td>Return</td>
                                                @elseif($lst->business_type == 5)
                                                    <td>Reversal</td>
                                                @endif

                                                <td>{{$lst->getPolicy->getBusinessClass->class_name ?? ''}}</td>
                                                <td>{{$lst->getPolicy->getSubBusinessClass->class_name ?? ''}}</td>
                                                <td>{{$lst->getCurrency->name ?? ''}}({{$lst->getCurrency->symbol ?? ''}})</td>
                                                <td class="text-right">{{$lst->getCurrency->symbol ?? ''}}{{ number_format($lst->sum_insured,2)}}
                                                </td>
                                                <td>{{$lst->premium_rate }}%</td>
                                                <td class="text-right">{{$lst->getCurrency->symbol ?? ''}}{{number_format($lst->gross_premium,2)}}
                                                </td>
                                                <td>{{$lst->commission_rate}}%</td>
                                                <td class="text-right">{{$lst->getCurrency->symbol ?? ''}}{{number_format($lst->commission,2)}}
                                                </td>
                                                <td>{{$lst->vat_rate }}%</td>
                                                <td class="text-right">{{$lst->getCurrency->symbol ?? ''}}{{number_format(($lst->vat_rate/100)*$lst->commission,2)}}</td>
                                                <td>{{$lst->currency ?? ''}}</td>
                                                <td class="text-right">{{$lst->getCurrency->symbol ?? ''}}{{number_format($lst->net_amount,2)}}
                                                </td>
                                                @if($lst->status == 0)
                                                    <td><label for="" class="badge badge-warning text-white">Pending</label></td>
                                                @else
                                                    <td><label for="" class="badge badge-success text-white">Approved</label>
                                                    </td>
                                                @endif
                                                <td>
                                                    <div class="btn-group">
                                                        <a class="text-primary" href="/policy/credit-note/view/{{$lst->slug}}" > Learn more

                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <h2>No record found</h2>
                                    @endif
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Credit Code</th>
                                        <th>Client No.</th>
                                        <th>Insured</th>
                                        <th>Cover Days</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Insurance Company.</th>
                                        <th>Option</th>
                                        <th>Business Type</th>
                                        <th>Business Class</th>
                                        <th>Sub Class</th>
                                        <th>Currency</th>
                                        <th>Sum Insured</th>
                                        <th>Premium Rate</th>
                                        <th>Gross Premium</th>
                                        <th>Commission Rate</th>
                                        <th>Commission</th>
                                        <th>VAT Rate</th>
                                        <th>VAT</th>
                                        <th>Exchange Rate</th>
                                        <th>Net Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-block">
                    <h5 class="sub-title">Recent Clients</h5>
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
                            @foreach ($clients->take(7) as $client)
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
    <script src="/assets/js/chart.min.js"></script>
    <script type="text/javascript" src="\assets\pages\accordion\accordion.js"></script>
    <script src="/assets/js/axios.min.js"></script>
    <script>
        $(document).ready(function(){
            //const url = "route('dashboard-chart', $tenantId)}}";
            /*Bar chart*/
            var barChartData = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: "Non-motor Policies",
                    backgroundColor: [
                        'rgba(95, 190, 170, 0.99)',
                        'rgba(95, 190, 170, 0.99)',
                        'rgba(95, 190, 170, 0.99)',
                        'rgba(95, 190, 170, 0.99)',
                        'rgba(95, 190, 170, 0.99)',
                        'rgba(95, 190, 170, 0.99)',
                        'rgba(95, 190, 170, 0.99)'
                    ],
                    hoverBackgroundColor: [
                        'rgba(26, 188, 156, 0.88)',
                        'rgba(26, 188, 156, 0.88)',
                        'rgba(26, 188, 156, 0.88)',
                        'rgba(26, 188, 156, 0.88)',
                        'rgba(26, 188, 156, 0.88)',
                        'rgba(26, 188, 156, 0.88)',
                        'rgba(26, 188, 156, 0.88)'
                    ],
                    data: [65, 59, 80, 81, 56, 55, 50,11,63,28,45,67],
                }, {
                    label: "Motor Policies",
                    backgroundColor: [
                        'rgba(290, 100, 236, 1)',
                        'rgba(290, 100, 236, 1)',
                        'rgba(290, 100, 236, 1)',
                        'rgba(290, 100, 236, 1)',
                        'rgba(290, 100, 236, 1)',
                        'rgba(290, 100, 236, 1)',
                        'rgba(290, 100, 236, 1)'
                    ],
                    hoverBackgroundColor: [
                        'rgba(103, 280, 237, 1)',
                        'rgba(103, 280, 237, 1)',
                        'rgba(103, 280, 237, 1)',
                        'rgba(103, 280, 237, 1)',
                        'rgba(103, 280, 237, 1)',
                        'rgba(103, 280, 237, 1)',
                        'rgba(103, 280, 237, 1)'
                    ],
                    //motor policies data
                    data: [60, 69, 85, 91, 58, 50, 45,90,56,12,78,23],
                }]
            };

            var bar = document.getElementById("barChart").getContext('2d');
            var myBarChart = new Chart(bar, {
                type: 'bar',
                data: barChartData,
                options: {
                    barValueSpacing: 20
                }
            });

        });
    </script>
@endsection
