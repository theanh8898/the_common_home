@extends('layouts.app')
@section('body_class')
    animsition page-login layout-full page-dark
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('theme/assets/examples/css/pages/login.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/common.css') }}">

@endsection

@section('content')
    <div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">>
        <div class="page-content vertical-align-middle animation-slide-top animation-duration-1 mt-p10">
            <div class="brand">
                <img class="brand-img" src="../../assets//images/logo.png" alt="...">
                <h2 class="brand-text">The Common Home</h2>
            </div>
            <p>Sign into your pages account</p>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label class="sr-only" for="inputEmail">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" name="email" placeholder="Email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="sr-only" for="inputPassword">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword" name="password"
                           placeholder="Password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                    @enderror
                </div>
                <div class="form-group clearfix">
                    <div class="checkbox-custom checkbox-inline checkbox-primary float-left">
                        <input type="checkbox" id="inputCheckbox" name="remember">
                        <label for="inputCheckbox">Remember me</label>
                    </div>
                    <a class="float-right" href="forgot-password.html">Forgot password?</a>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Sign in</button>
            </form>
            <footer class="page-copyright page-copyright-inverse">
                <p>WEBSITE BY Creation Studio</p>
                <p>© 2020. All RIGHT RESERVED.</p>
            </footer>
        </div>
    </div>

@endsection
