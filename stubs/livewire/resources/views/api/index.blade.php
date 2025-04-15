@extends('layouts/layoutMaster')

@php
  $breadcrumbs = [['link' => 'home', 'name' => 'Home'], ['name' => 'API Tokens']];
@endphp

@section('title', 'API Tokens')

@section('content')
  @livewire('api.api-token-manager')
@endsection
