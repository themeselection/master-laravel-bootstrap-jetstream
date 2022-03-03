@extends('layouts/blankLayout')

@section('title', 'Forgot Password')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('assets/vendor/css/pages/page-auth.css')) }}">
@endsection

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-4">

      <!-- Logo -->
      <div class="app-brand justify-content-center mb-5">
        <a href="index.html" class="app-brand-link gap-2">
          <span class="app-brand-logo demo bg-primary">@include('_partials.macros',["height"=>20,"withbg"=>'fill: #fff;'])</span>
          <span class="app-brand-text demo text-body fw-bold">{{config('variables.templateName')}}</span>
        </a>
      </div>
      <!-- /Logo -->
      <!-- Forgot Password -->
      <div class="card">
        <div class="card-body">
          <h4 class="mb-3">Forgot Password? 🔒</h4>
          <p class="mb-4">Enter your email and we'll send you instructions to reset your password</p>

          @if (session('status'))
            <div class="mb-1 text-success">
              {{ session('status') }}
            </div>
          @endif

          <form id="formAuthentication" class="mb-3" action="{{ route('password.email') }}" method="POST">
          @csrf
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="john@example.com" autofocus>
              @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary d-grid w-100">Send Reset Link</button>
          </form>
          <div class="text-center">
            @if (Route::has('login'))
            <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
              <i class="bx bx-chevron-left scaleX-n1-rtl"></i>
              Back to login
            </a>
            @endif
          </div>
        </div>
      </div>
      <!-- /Forgot Password -->
    </div>
  </div>
</div>
@endsection
