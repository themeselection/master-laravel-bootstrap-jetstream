@php
  use Illuminate\Support\Facades\Route;
  $configData = Helper::appClasses();
  $customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/blankLayout')

@section('title', 'Forgot Password')

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
          <img src="{{ asset('assets/img/illustrations/girl-unlock-password-' . $configData['theme'] . '.png') }}"
            class="img-fluid scaleX-n1-rtl" alt="Login image" width="700"
            data-app-dark-img="illustrations/girl-unlock-password-dark.png"
            data-app-light-img="illustrations/girl-unlock-password-light.png" />
        </div>
      </div>
      <!-- /Left Text -->

      <!-- Forgot Password -->
      <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-12 p-6">
        <div class="w-px-400 mx-auto mt-sm-12 mt-8 pt-5">
          <h4 class="mb-1">Forgot Password? 🔒</h4>
          <p class="mb-6">Enter your email and we'll send you instructions to reset your password</p>
          @if (session('status'))
            <div class="mb-1 text-success">
              {{ session('status') }}
            </div>
          @endif
          <form id="formAuthentication" class="mb-6" action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="mb-6">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                name="email" placeholder="john@example.com" autofocus>
              @error('email')
                <span class="invalid-feedback" role="alert">
                  <span class="fw-medium">{{ $message }}</span>
                </span>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary d-grid w-100">Send Reset Link</button>
          </form>
          <div class="text-center">
            @if (Route::has('login'))
              <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
                <i class="icon-base bx bx-chevron-left scaleX-n1-rtl me-1_5 align-top"></i>
                Back to login
              </a>
            @endif
          </div>
        </div>
      </div>
      <!-- /Forgot Password -->
    </div>
  </div>
@endsection
