@php
  use Illuminate\Support\Facades\Gate;
@endphp
<x-form-section submit="updateTeamName">
  <x-slot name="title">
    {{ __('Team Name') }}
  </x-slot>

  <x-slot name="description">
    {{ __('The team\'s name and owner information.') }}
  </x-slot>

  <x-slot name="form">
    <x-action-message on="saved">
      {{ __('Saved.') }}
    </x-action-message>

    <!-- Team Owner Information -->
    <div class="mb-6">
      <x-label class="form-label" value="{{ __('Team Owner') }}" />

      <div class="d-flex justify-content-start align-items-center user-name">
        <div class="avatar me-4"><img src="{{ $team->owner->profile_photo_url }}" alt="{{ $team->owner->name }}" alt="Avatar" class="rounded-circle"></div>
         <div class="d-flex flex-column">
          <h6 class="mb-1">{{ $team->owner->name }}</h6>
          <small>{{ $team->owner->email }}</small>
        </div>
      </div>
    </div>

    <!-- Team Name -->
    <div class="mb-5">
      <x-label class="form-label" for="name" value="{{ __('Team Name') }}" />

      <x-input id="name" type="text" class="{{ $errors->has('name') ? 'is-invalid' : '' }}" wire:model="state.name" :disabled="! Gate::check('update', $team)" />

      <x-input-error for="name" />
    </div>
  </x-slot>

  @if (Gate::check('update', $team))
  <x-slot name="actions">
    <div class="d-flex align-items-baseline">
      <x-button>
        {{ __('Save') }}
      </x-button>
    </div>
  </x-slot>
  @endif
</x-form-section>