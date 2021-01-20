@extends('layouts.master')

@section('title')
    Policy Settings
@endsection
@section('current-page')
    Policy Settings
@endsection
@section('current-page-brief')
    Policy Settings
@endsection

@section('extra-styles')
<link rel="stylesheet" href="/assets/css/datatables.min.css">
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
                                <a class="nav-link active" data-toggle="tab" href="#company_info" role="tab">Company Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#assets" role="tab">Assets</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#terms_privacy" role="tab">Terms & Conditions, Company Policy </a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content tabs card-block">
                            <div class="tab-pane active" id="company_info" role="tabpanel">
                                <h5 class="sub-title text-primary">Company Info</h5>
                                @if (session()->has('success'))
                                    <div class="alert-success alert background-success" role="alert">
                                        {!! session()->get('success') !!}
                                    </div>
                                @endif
                                <form action="{{url('company-settings/general-settings')}}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="">Company Name</label>
                                                <input type="text" placeholder="Company Name" name="company_name" value="{{old('company_name', $settings->company_name ?? '')}}" class="form-control">
                                                @error('company_name')
                                                    <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="">Official Email</label>
                                                <input type="text" placeholder="Official Email" name="official_email" value="{{old('official_email', $settings->official_email ?? '')}}" class="form-control">
                                                @error('official_email')
                                                    <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="">Office Phone 1</label>
                                                <input type="text" placeholder="Office Phone 1" name="office_phone_1" class="form-control" value="{{old('office_phone_1', $settings->office_phone_1 ?? '')}}">
                                                @error('office_phone_1')
                                                    <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="">Office Phone 2</label>
                                                <input type="text" placeholder="Office Phone 2" name="office_phone_2" class="form-control" value="{{old('office_phone_2', $settings->office_phone_2 ?? '')}}">
                                                @error('office_phone_2')
                                                    <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="">Tagline</label>
                                                <input type="text" placeholder="Tagline" name="tagline" class="form-control" value="{{old('tagline', $settings->tagline ?? '')}}">
                                                @error('tagline')
                                                    <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="">Company Prefix</label>
                                                <input type="text" placeholder="Company Prefix" name="company_prefix" class="form-control" value="{{old('company_prefix', $settings->company_prefix ?? '')}}">
                                                @error('company_prefix')
                                                    <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="">Postal Code</label>
                                                <input type="text" placeholder="Postal Code" name="postal_code" class="form-control" value="{{old('postal_code', $settings->postal_code ?? '')}}">
                                                @error('postal_code')
                                                    <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="">Office Address</label>
                                                <textarea placeholder="Office Address" style="resize: none;" name="office_address" class="form-control">{{old('office_address', $settings->office_address ?? '')}}</textarea>
                                                @error('office_address')
                                                    <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 d-flex justify-content-center">
                                            <div class="btn-group">
                                                <a href="" class="btn btn-danger btn-mini"><i class="ti-close mr-2"></i>Cancel</a>
                                                <button class="btn-primary btn-mini btn" type="submit"><i class="ti-check mr-2"></i> Save Changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <div class="tab-pane" id="assets" role="tabpanel">
                                <h5 class="sub-title text-primary">Assets</h5>
                                <form action="{{url('company-settings/assets-settings')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Company Logo</label>
                                                <input type="file" class="form-control-file" name="company_logo" id="company_logo">
                                                @error('company_logo')
                                                    <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                            </div>
                                            <img height="230" width="230" src="/assets/attachments/assets/logo/{{$settings->company_logo ?? 'logo.jpg'}}" alt="" id="company_logo_preview">
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Company Favicon</label>
                                                <input type="file" class="form-control-file" name="company_favicon" id="company_favicon">
                                                @error('company_favicon')
                                                    <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                            </div>
                                            <img height="230" width="230" src="/assets/attachments/assets/favicon/{{$settings->company_favicon ?? 'logo.jpg'}}" alt="" id="company_favicon_preview">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 d-flex justify-content-center">
                                            <div class="btn-group">
                                                <a href="" class="btn btn-danger btn-mini"><i class="ti-close mr-2"></i>Cancel</a>
                                                <button class="btn-primary btn-mini btn" type="submit"><i class="ti-check mr-2"></i> Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="terms_privacy" role="tabpanel">
                                <h5 class="sub-title text-primary">Terms & Conditions, Company Policy </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('dialog-section')
@endsection

@section('extra-scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $("#company_logo").change(function() {
            readURL(this, 'company_logo_preview');
        });
        $("#company_favicon").change(function() {
            readURL(this, 'company_favicon_preview');
        });
    });
    function readURL(input, target) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
            $('#'+target).attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
        }
</script>
@endsection
