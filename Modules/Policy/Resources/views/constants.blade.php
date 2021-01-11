@extends('layouts.master')

@section('title')
    Policy Settings
@endsection

@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\css\toastify.min.css">
    <link rel="stylesheet" type="text/css" href="\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
@endsection
@section('main-content')
<div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card">
            <div class="card-block">
                <div class="col-lg-12 col-xl-12">
                    <div class="sub-title">Policy Settings</div>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs  tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#agents" role="tab">Agents</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#business_class" role="tab">Business Class</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#sub_business_class" role="tab">Sub-business Class</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#settings2" role="tab">Vehicle Make</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#settings3" role="tab">State</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#debit_credit_note" role="tab">Debit | Credit Note</a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content tabs card-block">
                        <div class="tab-pane active" id="agents" role="tabpanel">
                            <h5 class="sub-title text-primary">Agents</h5>
                            <button class="btn btn-mini btn-primary new-agent float-right" type="button" data-toggle="modal" data-target="#new-agent-modal"><i class="ti-plus mr-2"></i>Add New Agent</button>
                            <div class="dt-responsive table-responsive mt-4">
                                <table id="agentsTable" class="portableTables table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Agent Name</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $serial = 1;
                                        @endphp
                                       @php
                                        $a = 1;
                                       @endphp
                                       @foreach($agents as $agent)
                                            <tr>
                                                <td>{{ $a++ }}</td>
                                                <td>{{ $agent->agent_name ?? '' }}</td>
                                                <td>{{ !is_null($agent->created_at) ? date('d F, Y', strtotime($agent->created_at)) : '-' }}
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#new-agent-modal"  class="edit-agent" data-agent="{{ $agent->agent_name ?? '' }}" data-agent-id="{{ $agent->id }}"><i class="ti-pencil text-warning"></i></a>
                                                </td>
                                            </tr>
                                       @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Agent Name</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="business_class" role="tabpanel">
                            <h5 class="sub-title text-primary">Business Class</h5>
                            <button class="float-right btn btn-mini btn-primary new-business-class" type="button" data-toggle="modal" data-target="#new-business-class-modal"><i class="ti-plus mr-2"></i>Add New Business Class</button>
                            <div class="dt-responsive table-responsive mt-4">
                                <table id="businessTable" class="portableTables table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Class Name</th>
                                            <th>Abbr.</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $serial = 1;
                                        @endphp
                                       @foreach($classes as $class)
                                            <tr>
                                                <td>{{ $serial++ }}</td>
                                                <td>{{ $class->class_name ?? '' }}</td>
                                                <td>{{ $class->abbr ?? '' }}</td>
                                                <td>{{ !is_null($class->created_at) ? date('d F, Y', strtotime($class->created_at)) : '-' }}
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#new-business-class-modal"  class="edit-business-class" data-business-class="{{ $class->class_name ?? '' }}" data-business-class-id="{{ $class->id }}"><i class="ti-pencil text-warning"></i></a>
                                                </td>
                                            </tr>
                                       @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Class Name</th>
                                            <th>Abbr.</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="sub_business_class" role="tabpanel">
                            <h5 class="sub-title text-primary">Sub-business Class</h5>
                            <button class="btn btn-mini btn-primary float-right sub-new-business-class" type="button" data-toggle="modal" data-target="#new-sub-business-class-modal"><i class="ti-plus mr-2"></i>Add New Sub-business Class</button>
                            <div class="dt-responsive table-responsive mt-4">
                                <table id="businessTable" class="portableTables table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Class Name</th>
                                            <th>Business Class.</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $serial = 1;
                                        @endphp
                                       @foreach($subs as $sub)
                                            <tr>
                                                <td>{{ $serial++ }}</td>
                                                <td>{{ $sub->class_name ?? '' }}</td>
                                                <td>{{ $sub->getBusinessClass->class_name ?? '' }}</td>
                                                <td>{{ !is_null($sub->created_at) ? date('d F, Y', strtotime($sub->created_at)) : '-' }}
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#new-sub-business-class-modal"  class="edit-sub-business-class" data-sub-business-class="{{ $sub->class_name ?? '' }}" data-sub-business-class-id="{{ $sub->id }}"><i class="ti-pencil text-warning"></i></a>
                                                </td>
                                            </tr>
                                       @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Class Name</th>
                                            <th>Business Class</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="messages1" role="tabpanel">
                            <h5 class="sub-title">Employment Types</h5>
                            <button type="button" class="btn btn-mini btn-primary"><i class="ti-plus mr-2"></i>Add New Employment Type</button>
                            <div class="clear-both mt-4"></div>
                            <table class="table table-bordered" id="employmentTypeTable">
                                <thead>
                                    <tr>
                                        <th >#</th>
                                        <th >Employment Type</th>
                                        <th >Added By</th>
                                        <th >Date</th>
                                        <th >Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $t = 1;
                                    @endphp
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="settings2" role="tabpanel">
                            <h5 class="sub-title">Academic Qualification</h5>
                            <button type="button" class="btn btn-mini btn-primary"><i class="ti-plus mr-2"></i>Add New Academic Qualification</button>
                            <div class="clear-both mt-4"></div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th >#</th>
                                        <th >Qualification</th>
                                        <th >Added By</th>
                                        <th >Date</th>
                                        <th >Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $q = 1;
                                    @endphp
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="debit_credit_note" role="tabpanel">
                            <h5 class="sub-title text-primary">Debit | Credit Note </h5>
                                <h3>debit note settings</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('dialog-section')
     <div class="modal fade" id="new-agent-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title agent-title">Add New Agent</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Agent Name</label>
                        <input type="text" class="form-control" name="agent_name" placeholder="Agent Name" id="agent_name">
                        <input type="hidden" name="agentId" id="agentId">
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger btn-mini waves-effect " data-dismiss="modal"><i class="ti-close mr-2"></i>Close</button>
                        <button type="button" class="btn btn-primary waves-effect waves-light btn-mini saveAgentBtn"><i class="ti-check mr-2"></i>Save</button>
                        <button type="button" class="btn btn-primary waves-effect waves-light btn-mini saveAgentChangesBtn" style="display: none;"><i class="ti-check mr-2"></i>Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="new-business-class-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title business-class-title">Add New Business Class</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Business Class Name</label>
                        <input type="text" class="form-control" name="business_class_name" placeholder="Business Class Name" id="business_class_name">
                        <input type="hidden" name="businessId" id="businessId">
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger btn-mini waves-effect " data-dismiss="modal"><i class="ti-close mr-2"></i>Close</button>
                        <button type="button" class="btn btn-primary waves-effect waves-light btn-mini saveBusinessClassBtn"><i class="ti-check mr-2"></i>Save</button>
                        <button type="button" class="btn btn-primary waves-effect waves-light btn-mini saveBusinessClassChangesBtn" style="display: none;"><i class="ti-check mr-2"></i>Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="new-sub-business-class-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title sub-business-class-title">Add New Sub-business Class</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Sub-business Class Name</label>
                        <input type="text" class="form-control" name="sub_business_class_name" placeholder="Sub-business Class Name" id="sub_business_class_name">
                    </div>
                    <div class="form-group">
                        <label>Business Class Name</label>
                        <select name="class" id="class" class="form-control">
                            <option disabled selected>Select business class</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->class_name ?? '' }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="subBusinessId" id="subBusinessId">
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger btn-mini waves-effect " data-dismiss="modal"><i class="ti-close mr-2"></i>Close</button>
                        <button type="button" class="btn btn-primary waves-effect waves-light btn-mini saveSubBusinessClassBtn"><i class="ti-check mr-2"></i>Save</button>
                        <button type="button" class="btn btn-primary waves-effect waves-light btn-mini saveSubBusinessClassChangesBtn" style="display: none;"><i class="ti-check mr-2"></i>Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')
<script type="text/javascript" src="\assets\pages\accordion\accordion.js"></script>
<script src="\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>

<script src="\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
<script src="\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
<script src="\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>

<script src="\assets\pages\data-table\js\data-table-custom.js"></script>
<script src="\assets\js\toastify.min.js"></script>
<script src="\assets\js\agent.js"></script>
<script src="\assets\js\business-class.js"></script>
<script src="\assets\js\sub-business-class.js"></script>
<script src="\assets\js\axios.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){

    });
</script>
@endsection
