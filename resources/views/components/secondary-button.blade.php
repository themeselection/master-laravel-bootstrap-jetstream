<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-label-secondary']) }}>
  {{ $slot }}
</button>
