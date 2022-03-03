@extends('layouts/blankLayout')

@section('title', '2 Factor Chanllenge')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('assets/vendor/css/pages/page-auth.css')) }}">
@endsection

@section('content')
<div class="authentication-wrapper authentication-basic px-4">
  <div class="authentication-inner py-4">
    <!-- Logo -->
    <div class="app-brand justify-content-center mb-5">
      <a href="index.html" class="app-brand-link gap-2">
        <span class="app-brand-logo demo bg-primary">@include('_partials.macros',["height"=>20,"withbg"=>'fill: #fff;'])</span>
        <span class="app-brand-text demo text-body fw-bold">{{config('variables.templateName')}}</span>
      </a>
    </div>
    <!-- /Logo -->
    <!--  Two Steps Verification -->
    <div class="card">
      <div class="card-body">
        <h4 class="mb-3">Two Step Verification 💬</h4>
        <div x-data="{ recovery: false }">
            <div class="mb-3" x-show="! recovery">
              Please confirm access to your account by entering the authentication code provided by your authenticator application.
            </div>

            <div class="mb-3" x-show="recovery">
              Please confirm access to your account by entering one of your emergency recovery codes.
            </div>

            <x-jet-validation-errors class="mb-1" />

            <form method="POST" action="{{ route('two-factor.login') }}">
              @csrf

              <div class="mb-3" x-show="! recovery">
                <x-jet-label class="form-label" value="{{ __('Code') }}" />
                <x-jet-input class="{{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" inputmode="numeric"
                  name="code" autofocus x-ref="code" autocomplete="one-time-code" />
                <x-jet-input-error for="code"></x-jet-input-error>
              </div>

              <div class="mb-3" x-show="recovery">
                <x-jet-label class="form-label" value="{{ __('Recovery Code') }}" />
                <x-jet-input class="{{ $errors->has('recovery_code') ? 'is-invalid' : '' }}" type="text"
                  name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" />
                <x-jet-input-error for="recovery_code"></x-jet-input-error>
              </div>

              <div class="d-flex justify-content-end mt-2">
                <button type="button" class="btn btn-outline-secondary me-1" x-show="! recovery"
                  x-on:click="recovery = true; $nextTick(() => { $refs.recovery_code.focus()})">Use a recovery code
                </button>

                <button type="button" class="btn btn-outline-secondary me-1" x-show="recovery"
                  x-on:click=" recovery = false; $nextTick(() => { $refs.code.focus() })">
                  Use an authentication code
                </button>

                <x-jet-button>
                  Log in
                </x-jet-button>
              </div>
            </form>
          </div>
      </div>
    </div>
    <!-- / Two Steps Verification -->
  </div>
</div>
@endsection
