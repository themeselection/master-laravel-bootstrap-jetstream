@php
$configData = Helper::appClasses();
$customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/blankLayout')

@section('title', 'Register Page')

@section('page-style')
<!-- Page -->
@vite('resources/assets/vendor/scss/pages/page-auth.scss')
@endsection

@section('content')
<div class="authentication-wrapper authentication-cover">
  <div class="authentication-inner row m-0">
    <!-- /Left Text -->
    <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center">
      <div class="flex-row text-center mx-auto">
        <img src="{{asset('assets/img/pages/register-'.$configData['style'].'.png')}}" alt="Auth Cover Bg color" width="520" class="img-fluid authentication-cover-img" data-app-light-img="pages/register-light.png" data-app-dark-img="pages/register-dark.png">
        <div class="mx-auto">
          <h3>A few clicks to get started 🚀</h3>
          <p>
            Let’s get started with your 14 days free trial and <br> start building your application today.
          </p>
        </div>
      </div>
    </div>
    <!-- /Left Text -->

    <!-- Register -->
    <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-5 p-4">
      <div class="w-px-400 mx-auto">
        <!-- Logo -->
        <div class="app-brand mb-4">
          <a href="{{url('/')}}" class="app-brand-link gap-2 mb-2">
            <span class="app-brand-logo demo">@include('_partials.macros',['height'=>20,'withbg' => "fill: #fff;"])</span>
            <span class="app-brand-text demo h3 mb-0 fw-bold">{{config('variables.templateName')}}</span>
          </a>
        </div>
        <!-- /Logo -->

        <!-- Register -->
        <h4 class="mb-2">Adventure starts here 🚀</h4>
        <p class="mb-4">Make your app management easy and fun!</p>

        <form id="formAuthentication" class="mb-3" action="{{ route('register') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="username" name="name" placeholder="johndoe" autofocus value="{{ old('name') }}" />
            @error('name')
            <span class="invalid-feedback" role="alert">
              <span class="fw-medium">{{ $message }}</span>
            </span>
            @enderror
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="john@example.com" value="{{ old('email') }}" />
            @error('email')
            <span class="invalid-feedback" role="alert">
              <span class="fw-medium">{{ $message }}</span>
            </span>
            @enderror
          </div>
          <div class="mb-3 form-password-toggle">
            <label class="form-label" for="password">Password</label>
            <div class="input-group input-group-merge @error('password') is-invalid @enderror">
              <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
              <span class="input-group-text cursor-pointer">
                <i class="bx bx-hide"></i>
              </span>
            </div>
            @error('password')
            <span class="invalid-feedback" role="alert">
              <span class="fw-medium">{{ $message }}</span>
            </span>
            @enderror
          </div>

          <div class="mb-3 form-password-toggle">
            <label class="form-label" for="password-confirm">Confirm Password</label>
            <div class="input-group input-group-merge">
              <input type="password" id="password-confirm" class="form-control" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
              <span class="input-group-text cursor-pointer">
                <i class="bx bx-hide"></i>
              </span>
            </div>
          </div>
          @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="mb-3">
              <div class="form-check @error('terms') is-invalid @enderror">
                <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" id="terms" name="terms" />
                <label class="form-check-label" for="terms">
                  I agree to the
                  <a href="{{ route('policy.show') }}" target="_blank">privacy policy</a> &
                  <a href="{{ route('terms.show') }}" target="_blank">terms</a>
                </label>
              </div>
              @error('terms')
                <div class="invalid-feedback" role="alert">
                    <span class="fw-medium">{{ $message }}</span>
                </div>
              @enderror
            </div>
          @endif
          <button type="submit" class="btn btn-primary d-grid w-100">Sign up</button>
        </form>

        <p class="text-center mt-2">
          <span>Already have an account?</span>
          @if (Route::has('login'))
          <a href="{{ route('login') }}">
            <span>Sign in instead</span>
          </a>
          @endif
        </p>

        <div class="divider my-4">
          <div class="divider-text">or</div>
        </div>

        <div class="d-flex justify-content-center">
          <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3">
            <i class="tf-icons bx bxl-facebook"></i>
          </a>

          <a href="javascript:;" class="btn btn-icon btn-label-google-plus me-3">
            <i class="tf-icons bx bxl-google-plus"></i>
          </a>

          <a href="javascript:;" class="btn btn-icon btn-label-twitter">
            <i class="tf-icons bx bxl-twitter"></i>
          </a>
        </div>
      </div>
    </div>
    <!-- /Register -->
  </div>
</div>
@endsection