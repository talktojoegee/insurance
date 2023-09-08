<div class="modal fade" id="activateAccountModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title">Activate Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('update-employee-account-status')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <input  type="hidden" value="{{$employee->id}}" placeholder="Enter Mobile No." name="employeeId" class="form-control">
                        <input type="hidden" name="status" value="1">
                    </div>
                    <div class="form-group">
                        <p>Are you sure you want to <code>Activate</code> {{$employee->first_name ?? '' }}'s account?</p>
                    </div>
                    <div class="form-group d-flex justify-content-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm  btn-default waves-effect " data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-primary waves-effect waves-light ">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
