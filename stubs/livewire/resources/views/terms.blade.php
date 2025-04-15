@php
  $configData = Helper::appClasses();
  $customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/blankLayout')

@section('title', 'Login')

@section('page-style')
  <!-- Page -->
  @vite('resources/assets/vendor/scss/pages/page-auth.scss')
@endsection

@section('content')
  <div class="authentication-wrapper authentication-basic px-4">
    <div class="authentication-inner py-4">
      <!-- Logo -->
      <div class="app-brand justify-content-center mb-5">
        <a href="{{ url('/') }}" class="app-brand-link gap-2">
          <span class="app-brand-logo demo bg-primary">@include('_partials.macros')</span>
          <span class="app-brand-text demo text-body fw-bold">{{ config('variables.templateName') }}</span>
        </a>
      </div>
      <!-- /Logo -->
      <div class="card">
        <div class="card-body">
          {!! $terms !!}
        </div>
      </div>
    </div>
  </div>
@endsection
