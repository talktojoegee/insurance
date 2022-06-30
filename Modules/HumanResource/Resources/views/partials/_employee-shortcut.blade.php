<div class="row">
    <div class="col-xl-12 col-lg-12  filter-bar">
        <nav class="navbar navbar-light bg-faded m-b-30 p-10">
            <div class="nav-item nav-grid">
                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-mini waves-effect waves-light"><i class="ti-back-left mr-2"></i>Go Back</a>
                <a href="{{ url('/human-resource') }}" class="btn btn-primary btn-mini waves-effect waves-light"><i class="icofont icofont-users-alt-3 mr-2"></i>Manage Employees</a>
                <a href="{{ url('/human-resource') }}" class="btn btn-warning btn-mini waves-effect waves-light"><i class="ti-sharethis mr-2"></i>Manage Permissions</a>
                @if($employee->account_status == 1)
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#deactivateAccountModal" class="btn btn-danger btn-mini waves-effect waves-light"><i class="ti-stamp mr-2"></i>Deactivate Account</a>
                @else
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#activateAccountModal" class="btn btn-success btn-mini waves-effect waves-light"><i class="ti-check mr-2"></i>Activate Account</a>
                @endif
            </div>
        </nav>
    </div>
</div>

