@props(['route', 'id'])
<div>
    <a href="{{ route($route, ['id' => $id]) }}" class="">
        <div>
            <i class="border ti ti-plus rounded p-1 me-1 bg-primary text-white"></i>
        </div>
    </a>
</div>
