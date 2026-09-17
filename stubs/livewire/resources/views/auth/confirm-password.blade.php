@php
  use Illuminate\Support\Facades\Route;
  $configData = Helper::appClasses();
  $customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/blankLayout')

@section('title', 'Confirm Password')

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
            data-app-light-img="illustrations/girl-unlock-password-light.png">
        </div>
      </div>
      <!-- /Left Text -->

      <!-- password confirm -->
      <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-12 p-6">
        <div class="w-px-400 mx-auto mt-sm-12 mt-8 pt-5">
          <h4 class="mb-1">Confirm Password</h4>
          <p class="mb-6">Please confirm your password before continuing.</p>
          <form id="twoStepsForm" action="{{ route('password.confirm') }}" method="POST">
            @csrf
            <div class="mb-6 form-password-toggle">
              <label class="form-label" for="password">Enter Password</label>
              <div class="input-group input-group-merge @error('password') is-invalid @enderror">
                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                  name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                  aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="icon-base bx bx-hide"></i></span>
              </div>
              @error('password')
                <span class="invalid-feedback" role="alert">
                  <span class="fw-medium">{{ $message }}</span>
                </span>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary d-grid w-100">Confirm Password</button>
          </form>
        </div>
      </div>
      <!-- / password confirm -->
    </div>
  </div>
@endsection
