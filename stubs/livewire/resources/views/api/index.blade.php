@extends('layouts/layoutMaster')

@php
$breadcrumbs = [['link' => 'home', 'name' => 'Home'], ['name' => 'API Tokens']];
@endphp

@section('title', 'API Tokens')


@section('page-style')
@vite([
  'resources/assets/vendor/scss/pages/page-auth.scss'
])
@endsection

@section('content')
  @livewire('api.api-token-manager')
@endsection
