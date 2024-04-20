@props(['route', 'name'])
<div>
    <a href="{{ route($route) }}" class="btn btn-primary">
        <i class="border ti ti-plus rounded p-1 me-1"></i>
        {{ $name }}</a>
</div>
