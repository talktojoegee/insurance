<div class="modal fade" id="permissionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" >
                <h6 class="modal-title text-uppercase" id="myModalLabel2">Access Level</h6>
                <button type="button" style="margin: 0px; padding: 0px;" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <form autocomplete="off" autcomplete="off" action="#" method="post" id="addBranch" data-parsley-validate="">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <h5>{{$employee->roles->first()->name ?? '' }}</h5>
                                    <div class="accordion-item mb-2 p-4">
                                        <div id="flush-collapse_" class="accordion-collapse collapse show" aria-labelledby="flush-heading_" data-bs-parent="#accordionFlushExample_" style="">
                                            <div class="accordion-body text-muted">
                                                <form action="">
                                                    <div class="row">
                                                        @if(count($employee->roles) > 0 )
                                                            @foreach($employee->roles->first()->permissions as $p)
                                                                <div class="col-md-3 col-lg-3">
                                                                    <div class="form-check form-checkbox-outline form-check-primary mb-3">
                                                                        <input class="form-check-input" type="checkbox"  checked>
                                                                        <label class="form-check-label" >
                                                                            {{$p->name ?? ''}}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <div class="col-md-3 col-lg-3">
                                                                <p>No permissions/roles </p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
