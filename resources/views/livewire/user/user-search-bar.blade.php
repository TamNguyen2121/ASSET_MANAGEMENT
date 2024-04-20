<div>
    <label class="form-label">{{ $label }}</label>
    <input type="text" class="form-control" wire:model.live='query' wire:keydown.escape='customReset'
        wire:keydown.tab='customReset'>
    <div class="w-100">
        <div class="position-absolute" wire:click.away='customReset'>
            @if (!empty($query))
                <ul class="list-group">
                    @if (!empty($result))
                        @foreach ($result as $data)
                            <button class="list-group-item text-start" wire:click='fillData("{{ $data->name }}")'
                                type="button">
                                <div class="d-block">
                                    {{ $data->name }}
                                    <br>
                                    <small>{{ $data->email }}</small>
                                </div>
                            </button>
                        @endforeach
                    @endif
                </ul>
            @endif
        </div>
    </div>
</div>
