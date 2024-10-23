@props([
    'type' => 'text',
    'placeholder' => null,
    'value' => null,
    'label' => null,
    'name' => null,
    'id' => null,
    'readonly' => false,
])
@if ($label != null)
    <label>{{ $label }}</label>
@endif
<div class="mb-3">
    <input type="{{ $type }}" class="form-control" placeholder="{{ $placeholder }}" value="{{ $value }}"
        name="{{ $name }}" id="{{ $id }}" {{ $readonly ? 'readonly' : '' }} />
</div>
