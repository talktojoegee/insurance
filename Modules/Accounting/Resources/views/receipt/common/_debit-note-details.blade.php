<div class="row">
    <div class="col-lg-12">
        <div class="general-info">
            <div class="row">
                <div class="col-lg-12 col-xl-12 col-md-12">
                    <h6 class="text-white text-uppercase ml-3 bg-secondary p-2">Policy Documentation</h6>
                    <div class="table-responsive">
                        <table class="table m-0">
                            <tbody>
                                <tr>
                                    <th scope="row">Policy No.</th>
                                    <td>{{$debit_note->policy_no ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Client No.</th>
                                    <td>{{$debit_note->getPolicy->getBusinessClass->abbr}}/{{date('m',strtotime($debit_note->getPolicy->getBusinessClass->created_at))}}/{{date('y',strtotime($debit_note->getPolicy->getBusinessClass->created_at))}}/{{$debit_note->getPolicy->policy_number}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Insurance Policy No.</th>
                                    <td>{{$debit_note->getPolicy->insurance_policy_number ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Business Class</th>
                                    <td>{{$debit_note->getPolicy->getBusinessClass->class_name ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Sub-business Class</th>
                                    <td>{{$debit_note->getPolicy->getSubBusinessClass->class_name ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Start Date</th>
                                    <td>{{date('d M, Y', strtotime($debit_note->getPolicy->start_date))}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">End Date</th>
                                    <td>{{date('d M, Y', strtotime($debit_note->getPolicy->start_date))}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-12 col-xl-12 col-md-12">
                    <h6 class="text-white text-uppercase ml-3 bg-secondary p-2">Client Information</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">Insured Name</th>
                                    <td>
                                        {{$debit_note->getClient->insured_name ?? ''}}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Email</th>
                                    <td>{{$debit_note->getClient->email ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Mobile No.</th>
                                    <td>{{$debit_note->getClient->mobile_no ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Address</th>
                                    <td>{{$debit_note->getClient->address ?? ''}}</td>
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
                                    <td>{{$debit_note->getCurrency->symbol ?? ''}}{{ number_format($debit_note->sum_insured,2)}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Premium Rate</th>
                                    <td>{{$debit_note->premium_rate}}%</td>
                                </tr>
                                <tr>
                                    <th scope="row">Gross Premium</th>
                                    <td>{{$debit_note->getCurrency->symbol ?? ''}}{{number_format($debit_note->gross_premium,2)}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Exchange Rate</th>
                                    <td>1</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
