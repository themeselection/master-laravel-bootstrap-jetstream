@php
  use Illuminate\Support\Facades\Gate;
@endphp
<x-action-section>
  <x-slot name="title">
    {{ __('Delete Team') }}
  </x-slot>

  <x-slot name="description">
    {{ __('Permanently delete this team.') }}
  </x-slot>

  <x-slot name="content">
    <p class="text-body-secondary">
      {{ __('Once a team is deleted, all of its resources and data will be permanently deleted. Before deleting this team, please download any data or information regarding this team that you wish to retain.') }}
    </p>

    <x-danger-button wire:click="$toggle('confirmingTeamDeletion')" wire:loading.attr="disabled">
      {{ __('Delete Team') }}
    </x-danger-button>

    <!-- Delete Team Confirmation Modal -->
    <x-confirmation-modal wire:model.live="confirmingTeamDeletion">
      <x-slot name="title">
        {{ __('Delete Team') }}
      </x-slot>

      <x-slot name="content">
        {{ __('Are you sure you want to delete this team? Once a team is deleted, all of its resources and data will be permanently deleted.') }}
      </x-slot>

      <x-slot name="footer">
        <x-secondary-button wire:click="$toggle('confirmingTeamDeletion')" wire:loading.attr="disabled">
          {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button wire:click="deleteTeam" wire:loading.attr="disabled">
          {{ __('Delete Team') }}
        </x-danger-button>
      </x-slot>
    </x-confirmation-modal>
  </x-slot>
</x-action-section>
