@extends('layouts.layoutMaster')
@php
  use Illuminate\Support\Facades\Gate;
  $breadcrumbs = [['link' => 'home', 'name' => 'Home'], ['name' => 'Create Team']];
@endphp
@section('title', 'Create Team')

@section('content')
  @livewire('teams.create-team-form')
@endsection
