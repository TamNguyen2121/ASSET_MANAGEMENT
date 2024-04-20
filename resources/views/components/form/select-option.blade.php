@props(['label', 'options', 'wire_model', 'error'])
<div>
    <label class="form-label">{{ $label }}</label>
    <select class="form-select" wire:model='{{ $wire_model }}'>
        @if ($options === null)
            <option value=""></option>
        @else
            <option value=""></option>
            @foreach ($options as $data)
                <option value="{{ $data->id }}">{{ $data->name }}</option>
            @endforeach
        @endif
    </select>
    @error($error)
        <span class="text-danger fst-italic">{{ $message }}</span>
    @enderror
</div>
