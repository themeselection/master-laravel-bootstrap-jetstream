@php
use Illuminate\Support\Facades\Route;
$configData = Helper::appClasses();
$customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/blankLayout')

@section('title', 'Confirm Password')

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
        <img src="{{asset('assets/img/pages/reset-password-'.$configData['style'].'.png')}}" alt="Auth Cover Bg color" width="520" class="img-fluid authentication-cover-img" data-app-light-img="pages/reset-password-light.png" data-app-dark-img="pages/reset-password-dark.png">
        <div class="mx-auto">
          <h3>Confirm password 👩🏻‍💻</h3>
          <p>
            Please confirm password for security reasons or <br> reset it by clicking on forgot password.
          </p>
        </div>
      </div>
    </div>
    <!-- /Left Text -->
    <!--  password confirm -->
    <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-5 p-4">
      <div class="w-px-400 mx-auto">
        <!-- Logo -->
        <div class="app-brand justify-content-center mb-4">
          <a href="{{url('/')}}" class="app-brand-link gap-2 mb-2">
            <span class="app-brand-logo demo">@include('_partials.macros',['height'=>20,'withbg' => "fill: #fff;"])</span>
            <span class="app-brand-text demo h3 mb-0 fw-bold">{{ config('variables.templateName') }}</span>
          </a>
        </div>
        <!-- /Logo -->
        <h4 class="mb-3">Confirm Password</h4>
        <p class="text-start mb-4">Please confirm your password before continuing.</p>
        <p class="fw-medium">Enter your password</p>
        <form id="twoStepsForm" action="{{ route('password.confirm') }}" method="POST">
          @csrf
          <div class="mb-3 form-password-toggle">
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
          <button type="submit" class="btn btn-primary d-grid w-100 mb-3">Confirm Password</button>
        </form>
      </div>
    </div>
    <!-- / password confirm -->
  </div>
</div>
@endsection