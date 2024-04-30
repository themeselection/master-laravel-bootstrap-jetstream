@php
  use Illuminate\Support\Facades\Gate;
@endphp
<div>
  @if (Gate::check('addTeamMember', $team))

    <!-- Add Team Member -->
    <x-form-section submit="addTeamMember">
      <x-slot name="title">
        {{ __('Add Team Member') }}
      </x-slot>

      <x-slot name="description">
        {{ __('Add a new team member to your team, allowing them to collaborate with you.') }}
      </x-slot>

      <x-slot name="form">
        <x-action-message on="saved">
          {{ __('Added.') }}
        </x-action-message>

        <div class="mb-6">
          {{ __('Please provide the email address of the person you would like to add to this team. The email address must be associated with an existing account.') }}
        </div>

        <!-- Member Email -->
        <div class="mb-5">
          <x-label class="form-label" for="email" value="{{ __('Email') }}" />
          <x-input id="name" type="email" class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
            wire:model="addTeamMemberForm.email" />
          <x-input-error for="email" />
        </div>

        <!-- Role -->
        @if (count($this->roles) > 0)
          <div class="my-5">
            <div>
              <x-label class="form-label" for="role" value="{{ __('Role') }}" />

              <input type="hidden" class="{{ $errors->has('role') ? 'is-invalid' : '' }}">
              <x-input-error for="role" />
            </div>

            <div class="list-group">
              @foreach ($this->roles as $index => $role)
                <a href="#" class="list-group-item list-group-item-action"
                  wire:click.prevent="$set('addTeamMemberForm.role', '{{ $role->key }}')">
                  <div>
                    <span class="{{ $addTeamMemberForm['role'] == $role->key ? 'fw-medium' : '' }}">
                      {{ $role->name }}
                    </span>
                    @if ($addTeamMemberForm['role'] == $role->key)
                      <svg class="ms-25 text-success fw-light" width="20" fill="none" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                      </svg>
                    @endif
                  </div>

                  <!-- Role Description -->
                  <div class="mt-2">
                    {{ $role->description }}
                  </div>
                </a>
              @endforeach
            </div>
          </div>
        @endif
      </x-slot>

      <x-slot name="actions">
        <x-button>
          {{ __('Add') }}
        </x-button>
      </x-slot>
    </x-form-section>
  @endif

  @if ($team->teamInvitations->isNotEmpty() && Gate::check('addTeamMember', $team))

    <!-- Team Member Invitations -->
    <div class="mt-4">
      <x-action-section>
      <x-slot name="title">
        {{ __('Pending Team Invitations') }}
      </x-slot>

      <x-slot name="description">
        {{ __('These people have been invited to your team and have been sent an invitation email. They may join the team by accepting the email invitation.') }}
      </x-slot>

      <x-slot name="content">
        @foreach ($team->teamInvitations as $invitation)
          <div class="d-flex align-items-center justify-content-between mt-2 mb-2">
            <div class="___class_+?13___">{{ $invitation->email }}</div>

            <div class="d-flex align-items-center">
              @if (Gate::check('removeTeamMember', $team))
                <!-- Cancel Team Invitation -->
                <button class="btn btn-link text-danger text-decoration-none"
                  wire:click="cancelTeamInvitation({{ $invitation->id }})">
                  {{ __('Cancel') }}
                </button>
              @endif
            </div>
          </div>
        @endforeach
      </x-slot>
    </x-action-section>
    </div>
  @endif

  @if ($team->users->isNotEmpty())

    <div class="mt-4">
      <!-- Manage Team Members -->
    <x-action-section>
      <x-slot name="title">
        {{ __('Team Members') }}
      </x-slot>

      <x-slot name="description">
        {{ __('All of the people that are part of this team.') }}
      </x-slot>

      <!-- Team Member List -->
      <x-slot name="content">
        @foreach ($team->users->sortBy('name') as $user)
          <div class="d-flex justify-content-between mt-2 mb-2">
            <div class="d-flex align-items-center">
              <div class="pe-2">
                <img width="32" class="rounded-circle" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
              </div>
              <span class="fw-medium">{{ $user->name }}</span>
            </div>

            <div class="d-flex">
              <!-- Manage Team Member Role -->
              @if (Gate::check('addTeamMember', $team) && Laravel\Jetstream\Jetstream::hasRoles())
                <button class="btn btn-link text-secondary" wire:click="manageRole({{ $user->id }})">
                  {{ Laravel\Jetstream\Jetstream::findRole($user->membership->role)->name }}
                </button>
              @elseif (Laravel\Jetstream\Jetstream::hasRoles())
                <button class="btn btn-link text-secondary disabled text-decoration-none ms-2">
                  {{ Laravel\Jetstream\Jetstream::findRole($user->membership->role)->name }}
                </button>
              @endif

              <!-- Leave Team -->
              @if ($this->user->id === $user->id)
                <button class="btn btn-link text-danger text-decoration-none"
                  wire:click="$toggle('confirmingLeavingTeam')">
                  {{ __('Leave') }}
                </button>

                <!-- Remove Team Member -->
              @elseif (Gate::check('removeTeamMember', $team))
                <button class="btn btn-link text-danger text-decoration-none"
                  wire:click="confirmTeamMemberRemoval('{{ $user->id }}')">
                  {{ __('Remove') }}
                </button>
              @endif
            </div>
          </div>
        @endforeach
      </x-slot>
    </x-action-section>
    </div>
  @endif

  <!-- Role Management Modal -->
  <x-dialog-modal wire:model.live="currentlyManagingRole">
    <x-slot name="title">
      {{ __('Manage Role') }}
    </x-slot>

    <x-slot name="content">
      <div class="list-group">
        @foreach ($this->roles as $index => $role)
          <a href="#" class="list-group-item list-group-item-action"
            wire:click.prevent="$set('currentRole', '{{ $role->key }}')">
            <div>
              <span class="{{ $currentRole == $role->key ? 'fw-medium' : '' }}">
                {{ $role->name }}
              </span>
              @if ($currentRole == $role->key)
                <svg class="ms-25 text-success fw-light" width="20" fill="none" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                  <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              @endif
            </div>

            <!-- Role Description -->
            <div class="mt-2">
              {{ $role->description }}
            </div>
          </a>
        @endforeach
      </div>
    </x-slot>

    <x-slot name="footer">
      <x-secondary-button wire:click="stopManagingRole" wire:loading.attr="disabled">
        {{ __('Cancel') }}
      </x-secondary-button>

      <x-button class="ms-2" wire:click="updateRole" wire:loading.attr="disabled">
        {{ __('Save') }}
      </x-button>
    </x-slot>
  </x-dialog-modal>

  <!-- Leave Team Confirmation Modal -->
  <x-confirmation-modal wire:model.live="confirmingLeavingTeam">
    <x-slot name="title">
      {{ __('Leave Team') }}
    </x-slot>

    <x-slot name="content">
      {{ __('Are you sure you would like to leave this team?') }}
    </x-slot>

    <x-slot name="footer">
      <x-secondary-button wire:click="$toggle('confirmingLeavingTeam')" wire:loading.attr="disabled">
        {{ __('Cancel') }}
      </x-secondary-button>

      <x-danger-button class="ms-2" wire:click="leaveTeam" wire:loading.attr="disabled">
        {{ __('Leave') }}
      </x-danger-button>
    </x-slot>
  </x-confirmation-modal>

  <!-- Remove Team Member Confirmation Modal -->
  <x-confirmation-modal wire:model.live="confirmingTeamMemberRemoval">
    <x-slot name="title">
      {{ __('Remove Team Member') }}
    </x-slot>

    <x-slot name="content">
      {{ __('Are you sure you would like to remove this person from the team?') }}
    </x-slot>

    <x-slot name="footer">
      <x-secondary-button wire:click="$toggle('confirmingTeamMemberRemoval')" wire:loading.attr="disabled">
        {{ __('Cancel') }}
      </x-secondary-button>

      <x-danger-button class="ms-2" wire:click="removeTeamMember" wire:loading.attr="disabled">
        {{ __('Remove') }}
      </x-danger-button>
    </x-slot>
  </x-confirmation-modal>
</div>
