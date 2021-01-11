@extends('layouts.master')

@section('title')
    Add New Motor  Policy Documentation
@endsection

@section('extra-styles')
    <link rel="stylesheet" href="/assets/css/select2.min.css">
@endsection
@section('main-content')

<div class="row" >
    <div class="col-xl-12 col-lg-12  filter-bar">
        <nav class="navbar navbar-light bg-faded m-b-30 p-10">
            <div class="nav-item nav-grid">
                <a href="{{ url('/human-resource/employees') }}" class="btn btn-primary btn-mini waves-effect waves-light"><i class="icofont icofont-car-alt-4 mr-2"></i>Motor Policy</a>
                <a href="{{ url('/policy/non-motor') }}" class="btn btn-primary btn-mini waves-effect waves-light"><i class="icofont icofont-plane-ticket mr-2"></i>Non-motor Policy</a>
            </div>
        </nav>
    </div>
</div>
<div class="row" id="motor">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-block">
                <h5 class="sub-title">Add New Motor Policy</h5>
                <div class="alert alert-success background-success" role="alert" v-if="change_success">
                    <strong>Success!</strong> New policy documentation registered.
                </div>
                <h5 class="mb-3 sub-title text-primary"><strong>1.</strong> Policy Documentation</h5>
                @if(session()->has('success'))
                    <div class="alert alert-success background-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="icofont icofont-close-line-circled text-white"></i>
                        </button>
                        {!!  session()->get('success') !!}
                    </div>
                @endif
                <form action="{{url('/policy/add-new-policy')}}" method="post" autocomplete="off" >
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12">
                            <div class="form-group">
                                <label>Policy Number</label>
                                <input class="form-control" readonly v-model="policy.policy_number" placeholder="Policy Number" name="policy_number">
                                @error('policy_number')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12">
                            <div class="form-group">
                                <label>Insurance Policy Number</label>
                                <input class="form-control" v-model="policy.insurance_policy_number" placeholder="Insurance Policy Number" name="insurance_policy_number">
                                <small class="form-text text-danger" v-if="errs.insurance_policy_number"> @{{errs.insurance_policy_number[0]}} </small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12">
                            <div class="form-group">
                                <label>Insurance Period</label>
                                <div class="input-group input-group-button">
                                    <span class="input-group-addon btn btn-primary" id="basic-addon9">
                                        <span class="">Start Date</span>
                                    </span>
                                    <input type="date" class="form-control" v-model="policy.start_date" placeholder="Start Date">
                                    <span class="input-group-addon btn btn-primary" id="basic-addon9">
                                        <span class="">End Date</span>
                                    </span>
                                    <input type="date" class="form-control" v-model="policy.end_date" placeholder="End Date">
                                </div>
                                <small class="form-text text-danger" v-if="errs.end_date">@{{errs.end_date[0]}}</small>
                                <br>
                                <small class="form-text text-danger" v-if="errs.start_date">@{{errs.start_date[0]}}</small>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-3 col-sm-4">
                            <div class="form-group">
                                <label>Business Class</label>
                                <select class="form-control js-example-basic-single" v-model="policy.business_class" @change="getSubBusinessClass"  value="{{ old('business_class') }}" name="business_class" id="business_class">
                                    <option selected disabled >Select business class</option>
                                    <option v-for="(bclass, index) in business_classes" :value="bclass.id">@{{bclass.class_name}}</option>
                                </select>
                            </div>
                            <small class="form-text text-danger" v-if="errs.class">@{{errs.class[0]}}</small> <br>
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-3 col-sm-4">
                            <div class="form-group">
                                <label>Sub-business Class</label>
                                <select v-model="policy.sub_business_class" class="form-control js-example-basic-single" value="{{ old('sub_business_class') }}" name="sub_business_class" id="sub_business_class">
                                    <option v-for="(bclass, index) in sub_business_classes" :value="bclass.id">@{{bclass.class_name}}</option>
                                </select>
                            </div>
                            <small class="form-text text-danger" v-if="errs.sub_class">@{{errs.sub_class[0]}}</small>
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-3 col-sm-4">
                            <div class="form-group">
                                <label>Agent</label>
                                <select class="form-control" v-model="policy.agent">
                                    <option v-for="(agent, index) in policy.agents" :value="agent.id" :key="agent.id">@{{agent.agent_name}}</option>
                                </select>
                            </div>
                            <small class="form-text text-danger" v-if="errs.agent">@{{errs.agent[0]}}</small>
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-3 col-sm-12">
                            <div class="form-group">
                                <label>Policy Documentation For</label>
                                <select class="form-control" name="policy_for" v-model="policy.documentation_for">
                                    <option selected disabled>Select policy for</option>
                                    <option value="1">Existing Client</option>
                                    <option value="2">New Client</option>
                                </select>
                                <small class="form-text text-danger" v-if="errs.agent">@{{errs.documentation_for[0]}}</small>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-3 col-sm-12 existing-client" v-if="policy.documentation_for == 1">
                            <div class="form-group">
                                <label>Client</label>
                                <select class="form-control" v-model="policy.client">
                                    <option v-for="(client, index) in policy.clients" :value="client.id" :key="client.id">@{{client.insured_name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12 client" v-if="policy.documentation_for != 1">
                            <div class="form-group">
                                <label>Insured Name</label>
                                <input class="form-control" v-model="policy.insured_name" type="text"  placeholder="Insured Name" name="insured_name" id="insured_name">
                                <small class="form-text text-danger" v-if="errs.insured_name">@{{errs.insured_name[0]}}</small>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12 client" v-if="policy.documentation_for != 1">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input class="form-control" type="email" v-model="policy.email" placeholder="Email Address" name="email_address" id="email_address">
                                <small class="form-text text-danger" v-if="errs.email">@{{errs.email[0]}}</small>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12 client" v-if="policy.documentation_for != 1">
                            <div class="form-group">
                                <label>Mobile No.</label>
                                <input class="form-control" type="text" v-model="policy.mobile_number" placeholder="Mobile No." name="mobile_no" id="mobile_no">
                                <small class="form-text text-danger" v-if="errs.mobile_number">@{{errs.mobile_number[0]}}</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12 client" v-if="policy.documentation_for != 1">
                            <div class="form-group">
                                <label>Office/Residential Address</label>
                                <textarea placeholder="Office/Residential Address" v-model="policy.address" name="address" id="address" class="form-control" style="resize: none;">{{ old('address') }}</textarea>
                                <small class="form-text text-danger" v-if="errs.address">@{{errs.address[0]}}</small>
                            </div>
                        </div>
                    </div>
                    <h5 class="mb-3 sub-title text-primary"><strong>2.</strong> Vehicle Information</h5>
                    <div class="row " id="vehicle_wrapper" v-for="(list, index) in policy.vehicle">
                        <div class="row mt-2">
                            <div class="col-md-2">
                                <label for="" class="badge badge-primary">@{{index+1}}</label>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xl-4 col-sm-6">
                           <div class="form-group">
                                <label>Cover Type</label>
                                <select name="" id="" class="form-control" v-model="list.cover_type">
									<option v-for="(cover, index) in policy.covers" :value="cover.id" :key="cover.id">@{{cover.cover_type}}</option>
                                </select>
                                <small  class="form-text text-muted">Choose cover type.</small>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xl-4 col-sm-6">
                           <div class="form-group">
                                <label>Make</label>
                                <select v-model="list.make" class="form-control">
									<option v-for="(make, index) in policy.makes" :value="make.id" :key="make.id">@{{make.make_name}}</option>
								</select>
								<small  class="form-text text-muted">Choose vehicle make.</small>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xl-4 col-sm-6">
                            <div class="form-group">
                                <label>Registration Number</label>
                                <input type="text" class="form-control" placeholder="Registration Number" v-model="list.reg_no">
								<small id="emailHelp2" class="form-text text-muted"> </small>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xl-4 col-sm-6">
                            <div class="form-group">
                                <label>Engine Number</label>
                                <input type="text" v-model="list.engine_no"  class="form-control" placeholder="Engine Number">
                                <small id="emailHelp2" class="form-text text-muted"> </small>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xl-4 col-sm-6">
                            <div class="form-group">
                                <label>Chassis Number</label>
                                <input type="text" v-model="list.chassis_no" class="form-control" placeholder="Chassis Number">
                                <small id="emailHelp2" class="form-text text-muted"> </small>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xl-4 col-sm-6">
                           <div class="form-group">
                                <label>State Issued</label>
                                <select v-model="list.state_issued" class="form-control">
                                    <option v-for="(state, index) in policy.states" :key="state.id" :value="state.id">@{{state.state_name}}</option>
                                </select>
                                <small id="emailHelp2" class="form-text text-muted"> </small>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xl-4 col-sm-6">
                           <div class="form-group">
                                <label for="vehicle_value">Vehicle Value <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" v-model="list.vehicle_value" class="form-control" placeholder="Vehicle Value">
                                <small id="emailHelp2" class="form-text text-muted"> </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn btn-danger  btn-mini" @click.prevent="removeFromList(index)"> <i class="ti-close mr-2"></i> Remove From List</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="btn-group float-right">
                                <button class="btn btn-primary btn-mini" @click.prevent="addAnotherVehicle"><i class="ti-plus mr-2"></i>Add Another Vehicle</button>
                            </div>
                        </div>
                    </div>
                    <h5 class="mb-3 sub-title text-primary"> <strong>3.</strong> Payment Information</h5>
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xl-6 col-sm-6">
                           <div class="form-group">
                                <label>Sum Insured</label>
                                <input class="form-control" type="number" step="0.01" v-model="policy.sum_insured" placeholder="Sum Insured" name="sum_insured">
                                <small class="form-text text-danger" v-if="errs.sum_insured">@{{errs.sum_insured[0]}}</small>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-3 col-sm-6">
                            <div class="form-group">
                                <label>Currency</label>
                                <select name="" id="" class="form-control" v-model="policy.currency">
									<option v-for="(currency, index) in policy.currencies" :value="currency.id" :key="currency.id">@{{currency.name}} (@{{currency.symbol}})</option>
                                </select>
                                <small  class="form-text text-muted">Choose currency.</small>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-3 col-sm-6">
                            <div class="form-group">
                                <label>Exchange Rate</label>
                                <input type="number" step="0.01" class="form-control" value="{{ old('exchange_rate', 1) }}" name="exchange_rate" id="exchange_rate">
                                @error('exchange_rate')
                                    <i class="text-danger mt-2">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xl-6 col-sm-6">
                           <div class="form-group">
                                <label>Premium Rate</label>
                                <input type="number" step="0.01" class="form-control" v-model="premium_rate" placeholder="Premium Rate">
							<small class="form-text text-danger" v-if="errs.premium_rate">@{{errs.premium_rate[0]}}</small>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-sm-6">
                           <div class="form-group">
                                <label>Gross Premium</label>
                                <input type="number" step="0.01" class="form-control" :value="grossPremium" readonly placeholder="Gross Premium">
							<small class="form-text text-success" v-if="currency == 'Dollar'">₦@{{(grossPremium*exchange_rate).toLocaleString()}}</small>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12 d-flex justify-content-center">
                            <div class="btn-group">
                                <a class="btn btn-danger btn-mini" href=""><i class="ti-close mr-2"></i> Cancel</a>
                                <button type="submit" @click.prevent="postMotorPolicy" class="btn btn-primary btn-mini"><i v-if="!processing" class="ti-check mr-2"></i> <i v-if="processing" class="feather icon-aperture rotate-refresh mr-2"></i> Submit</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('extra-scripts-exception')
<script src="/js/motor.js"></script>
@endsection
