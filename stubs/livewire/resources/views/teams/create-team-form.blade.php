@php
  use Illuminate\Support\Facades\Gate;
@endphp
<x-form-section submit="createTeam">
  <x-slot name="title">
    {{ __('Team Details') }}
  </x-slot>

  <x-slot name="description">
    {{ __('Create a new team to collaborate with others on projects.') }}
  </x-slot>

  <x-slot name="form">
    <div class="mb-6">
      <x-label class="form-label" value="{{ __('Team Owner') }}" />

      <div class="d-flex justify-content-start align-items-center user-name">
        <div class="avatar me-4"><img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" alt="Avatar" class="rounded-circle"></div>
         <div class="d-flex flex-column">
          <h6 class="mb-1">{{ $this->user->name }}</h6>
          <small>{{ $this->user->email }}</small>
        </div>
      </div>
    </div>

    <div class="mb-5">
      <x-label class="form-label" for="name" value="{{ __('Team Name') }}" />
      <x-input id="name" type="text" class="{{ $errors->has('name') ? 'is-invalid' : '' }}"
        wire:model="state.name" autofocus />
      <x-input-error for="name" />
    </div>
  </x-slot>

  <x-slot name="actions">
    <x-button>
      {{ __('Create') }}
    </x-button>
  </x-slot>
</x-form-section>
