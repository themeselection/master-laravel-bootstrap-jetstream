@php
  use Illuminate\Support\Facades\Route;
  use Illuminate\Support\Facades\Auth;
  $configData = Helper::appClasses();
  $customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/blankLayout')

@section('title', 'Verify Email')

@section('page-style')
  <!-- Page -->
  @vite('resources/assets/vendor/scss/pages/page-auth.scss')
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
          <img src="{{ asset('assets/img/illustrations/boy-verify-email-' . $configData['theme'] . '.png') }}"
            class="img-fluid" alt="Login image" width="700" data-app-dark-img="illustrations/boy-verify-email-dark.png"
            data-app-light-img="illustrations/boy-verify-email-light.png">
        </div>
      </div>
      <!-- /Left Text -->

      <!--  Verify email -->
      <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-12 p-6">
        <div class="w-px-400 mx-auto mt-sm-12 mt-8 pt-5">
          <h4 class="mb-1">Verify your email ✉️</h4>
          @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success" role="alert">
              <div class="alert-body">
                A new verification link has been sent to the email address you provided during registration.
              </div>
            </div>
          @endif
          <p class="text-start mb-0">
            Account activation link sent to your email address: <span
              class="fw-medium text-heading">{{ Auth::user()->email }}</span> Please follow the link inside to continue.
          </p>
          <div class="mt-6 d-flex flex-column gap-2">
            <form method="POST" action="{{ route('verification.send') }}">
              @csrf
              <button type="submit" class="w-100 btn btn-label-secondary">Click here to request
                another</button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="w-100 btn btn-danger">Log Out</button>
            </form>
          </div>
        </div>
      </div>
      <!-- / Verify email -->
    </div>
  </div>
@endsection
