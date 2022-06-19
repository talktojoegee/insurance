<div class="row">
    <div class="col-xl-12 col-lg-12  filter-bar">
        <nav class="navbar navbar-light bg-faded m-b-30 p-10 justify-content-end">
            <div class="nav-item nav-grid">
                <a href="{{ url()->previous()}}" class="btn btn-secondary btn-mini waves-effect waves-light"><i class="icofont icofont-arrow-left mr-2"></i>Go Back</a>
                <a href="javascript:void(0);" data-toggle="modal" data-target="#sendSms" class="btn btn-primary btn-mini waves-effect waves-light"><i class="icofont icofont-phone mr-2"></i>Send SMS</a>
                <a href="{{ url('/policy/create') }}" class="btn btn-warning btn-mini waves-effect waves-light"><i class="icofont icofont-link mr-2"></i>Assign Client...</a>
                <a href="{{ url('/policy/create') }}" class="btn btn-info btn-mini waves-effect waves-light"><i class="icofont icofont-envelope-open mr-2"></i>Send Email</a>
            </div>
        </nav>
    </div>
</div>
