@props(['label', 'height', 'wire_model'])
<div>
    <div>
        <h6 class="form-label">{{ $label }}</h6>
    </div>
    <div class="form-floating">
        <textarea class="form-control" placeholder="" id="floatingTextarea2" style="height:{{ $height }}px"
            wire:model='{{ $wire_model }}'></textarea>
        <label for="floatingTextarea2">{{ $label }}</label>
    </div>
</div>
