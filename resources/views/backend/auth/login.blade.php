@extends('backend.auth.auth_master')

@section('auth_title')
    Login | Admin Panel
@endsection

@section('auth-content')
     <!-- login area start -->
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative"
        style="background:url(../assets/images/big/auth-bg.jpg) no-repeat center center;">
        <div class="row" style="justify-content: center">
            <div class="col-lg-7 col-md-7 bg-white" style="padding: 30px">
                @include('backend.layouts.partials.messages')
                <div class="p-3">
                    <div class="text-center">
                        <h2>Roznamcha</h2>
                    </div>
                    <h4 class="mt-3 text-center">Sign In</h4>

                    <form method="POST" class="mt-4" action="{{ route('admin.login.submit') }}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mb-3" style="display: flex; flex-direction: row; justify-content: space-between;">
                                    <label for="exampleInputEmail1">Email address or Username</label>
                                    <input type="text" id="exampleInputEmail1" name="email">
                                </div>
                                <div class="text-danger"></div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-3" style="display: flex; flex-direction: row; justify-content: space-between;">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" id="exampleInputPassword1" name="password">
                                </div>
                                <div class="text-danger"></div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="submit-btn-area mt-3" style="display: flex; justify-content: center">
                                <button class="btn btn-rounded btn-primary" id="form_submit" type="submit">Submit <i class="ti-arrow-right"></i></button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- login area end -->
@endsection