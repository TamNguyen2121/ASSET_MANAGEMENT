@props(['action', 'id', 'icon' => 'ti ti-trash'])
<button class="btn btn-danger" wire:click.prevent='{{ $action }}("{{ $id }}")'><i
        class="{{$icon}}"></i></button>
