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
                                    <td>{{$policy->policy_number ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Client No.</th>
                                    <td>{{$policy->getBusinessClass->abbr}}/{{date('m',strtotime($policy->getBusinessClass->created_at))}}/{{date('y',strtotime($policy->getBusinessClass->created_at))}}/{{$policy->policy_number}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Insurance Policy No.</th>
                                    <td>{{$policy->insurance_policy_number ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Business Class</th>
                                    <td>{{$policy->getBusinessClass->class_name ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Sub-business Class</th>
                                    <td>{{$policy->getSubBusinessClass->class_name ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Start Date</th>
                                    <td>{{date('d M, Y', strtotime($policy->start_date))}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">End Date</th>
                                    <td>{{date('d M, Y', strtotime($policy->start_date))}}</td>
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
                                        {{$policy->getClient->insured_name ?? ''}}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Email</th>
                                    <td>{{$policy->getClient->email ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Mobile No.</th>
                                    <td>{{$policy->getClient->mobile_no ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Address</th>
                                    <td>{{$policy->getClient->address ?? ''}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
