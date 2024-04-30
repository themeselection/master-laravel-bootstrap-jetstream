@props(['submit'])

<div class="card">
  <div class="card-header">
    <h5 class="card-title">{{ $title }}</h5>
    <p class="card-subtitle">{{ $description }}</p>
  </div>
  <div class="card-body">
    <form wire:submit.prevent="{{ $submit }}">
      {{ $form }}
      @if (isset($actions))
        <div class="d-flex justify-content-end">
          {{ $actions }}
        </div>
      @endif
    </form>
  </div>
</div>
