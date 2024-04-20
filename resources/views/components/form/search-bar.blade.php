@props(['label', 'type', 'wire_model', 'error', 'disabled' => false])
<div class="mb-3">
    <label class="form-label">{{ $label }}</label>
    <input type="{{ $type }}" class="form-control" wire:model='{{ $wire_model }}'
        @if ($disabled) disabled @endif>
    @error($error)
        <span class="text-danger fst-italic">{{ $message }}</span>
    @enderror
</div>
