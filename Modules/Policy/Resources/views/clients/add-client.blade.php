
@extends('layouts.master')

@section('title')
    Add Client
@endsection

@section('extra-styles')

@endsection

@section('current-page')
    Add Client
@endsection
@section('current-page-brief')
    Add Client
@endsection
@section('main-content')
    @include('policy::partials._client-shortcut')
    <div class="row">
        <div class="col-sm-8 col-md-8 offset-2 offset-md-2">
            <div class="card">
                <div class="card-block">
                    <h5 class="sub-title text-primary">Add Client</h5>
                    @if(session()->has('success'))
                        <div class="alert alert-success background-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!!  session()->get('success') !!}
                        </div>
                    @endif
                    @if(session()->has('error'))
                        <div class="alert alert-warning background-warning">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!!  session()->get('error') !!}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                            <form action="{{url('/policy/add-client')}}" method="post" class="">
                                @csrf
                                <div class="form-group">
                                    <label for="">Full Name</label>
                                    <input type="text" required name="name" placeholder="Full Name" value="{{ old('name') }}"  class="form-control">
                                    @error('name') <i>{{$message}}</i> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" required name="email" placeholder="Email Address" value="{{ old('email') }}"  class="form-control">
                                    @error('email') <i>{{$message}}</i> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Mobile No.</label>
                                    <input type="text" name="mobile_no" placeholder="Mobile No." value="{{ old('mobile_no') }}"  class="form-control">
                                    @error('mobile_no') <i>{{$message}}</i> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <textarea name="address" style="resize: none;" placeholder="Address" class="form-control">{{old('address')}}</textarea>
                                    @error('address') <i>{{$message}}</i> @enderror
                                </div>
                                <div class="form-group d-flex justify-content-center">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('extra-scripts')

@endsection
