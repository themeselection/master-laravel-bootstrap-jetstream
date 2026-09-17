@php
  use Illuminate\Support\Facades\Route;
  $configData = Helper::appClasses();
  $customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/blankLayout')

@section('title', 'Reset Password')

@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
@endsection

@section('content')
  <div class="authentication-wrapper authentication-cover">
    <!-- Logo -->
    <a href="{{ url('/') }}" class="app-brand auth-cover-brand gap-2">
      <span class="app-brand-logo demo">@include('_partials.macros')</span>
      <span class="app-brand-text demo text-heading fw-bold">{{ config('variables.templateName') }}</span>
    </a>
    <!-- /Logo -->
    <div class="authentication-inner row m-0">
      <!-- /Left Text -->
      <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center p-5">
        <div class="w-100 d-flex justify-content-center">
          <img src="{{ asset('assets/img/illustrations/boy-with-laptop-' . $configData['theme'] . '.png') }}"
            class="img-fluid scaleX-n1-rtl" alt="Login image" width="700"
            data-app-dark-img="illustrations/boy-with-laptop-dark.png"
            data-app-light-img="illustrations/boy-with-laptop-light.png">
        </div>
      </div>
      <!-- /Left Text -->

      <!-- Reset Password -->
      <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-12 p-6">
        <div class="w-px-400 mx-auto mt-sm-12 mt-8 pt-5">
          <h4 class="mb-1">Reset Password 🔒</h4>
          <p class="mb-6"><span class="fw-medium">Your new password must be different from previously used
              passwords</span></p>
          <form id="formAuthentication" class="mb-6" action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <div class="mb-6">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                name="email" placeholder="john@example.com" value="{{ Request()->email }}" readonly />
              @error('email')
                <span class="invalid-feedback" role="alert">
                  <span class="fw-medium">{{ $message }}</span>
                </span>
              @enderror
            </div>
            <div class="mb-6 form-password-toggle">
              <label class="form-label" for="password">New Password</label>
              <div class="input-group input-group-merge @error('password') is-invalid @enderror">
                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                  name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                  aria-describedby="password" autofocus />
                <span class="input-group-text cursor-pointer"><i class="icon-base bx bx-hide"></i></span>
              </div>
              @error('password')
                <span class="invalid-feedback" role="alert">
                  <span class="fw-medium">{{ $message }}</span>
                </span>
              @enderror
            </div>
            <div class="mb-6 form-password-toggle">
              <label class="form-label" for="confirm-password">Confirm Password</label>
              <div class="input-group input-group-merge">
                <input type="password" id="confirm-password" class="form-control" name="password_confirmation"
                  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                  aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="icon-base bx bx-hide"></i></span>
              </div>
            </div>
            <button type="submit" class="btn btn-primary d-grid w-100 mb-6">Set new password</button>
            <div class="text-center">
              @if (Route::has('login'))
                <a href="{{ route('login') }}">
                  <i class="icon-base bx bx-chevron-left scaleX-n1-rtl me-1_5 align-top"></i>
                  Back to login
                </a>
              @endif
            </div>
          </form>
        </div>
      </div>
      <!-- /Reset Password -->
    </div>
  </div>
@endsection
