<div>
    <div class="row">
        <div class="col-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Thêm mới loại tài sản</h5>
                    <form wire:submit.prevent='createEquipmentCategory'>
                        <div class="d-flex justify-content-between">
                            <div class="col-5">
                                <x-form.input :label="'Mã loại tài sản'" :type="'text'" :wire_model="'code'"
                                    :error="'code'"></x-form.input>
                            </div>
                            <div class="col-5">
                                <x-form.input :label="'Tên loại tài sản'" :type="'text'" :wire_model="'name'"
                                    :error="'name'"></x-form.input>

                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="col-5">
                                <label class="form-label">Kiểu tài sản</label>
                                <div class="mb-3">
                                    <span class="{{ $class }}" wire:click.live='clickEditEquipment'>
                                        {{ $label }}
                                    </span>
                                    @if ($editEquipmentType == true)
                                        <span class="btn btn-primary" wire:click.live='addNew()'>
                                            Thêm mới kiểu tài sản
                                        </span>
                                    @endif
                                </div>
                                @if ($addNewStatus == true)
                                    <div class="my-3">
                                        <div class="d-flex gap-3">
                                            <input type="text" class="form-control w-100" wire:model='newType'
                                                placeholder="Kiểu tài sản mới">
                                            <span class="btn btn-primary" wire:click.prevent='addNewType()'>Thêm</span>
                                        </div>
                                        <div class="">
                                            @if ($addNewStatus == true)
                                                @error('newType')
                                                    <span class="text-danger fst-italic">{{ $message }}</span>
                                                @enderror
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                <ul class="list-group equipment-type">
                                    @foreach ($asset_type as $index => $data)
                                        <li class="list-group-item py-3 d-flex justify-content-between"
                                            id="radio{{ $index }}">
                                            <div>
                                                @if ($editTypeId === $data->id)
                                                    <input type="text" wire:model='editTypeName'
                                                        class="form-control">
                                                    @error('editTypeName')
                                                        <span class="text-danger fst-italic">{{ $message }}</span>
                                                    @enderror
                                                @else
                                                    @if ($editEquipmentType == false)
                                                        <input class="form-check-input" type="radio"
                                                            value="{{ $data->id }}" wire:model='asset_type_id'
                                                            name="asset_type_id">
                                                    @endif
                                                    <label class="form-check-label mx-3" for="radio{{ $index }}">
                                                        {{ $data->name }}
                                                    </label>
                                                @endif
                                            </div>
                                            @if ($editTypeId === $data->id)
                                                <div class="">
                                                    <span wire:click='updateType({{ $editTypeId }})'
                                                        class="custom-btn bi bi-save mx-1"></span>
                                                    <span wire:click.live='cancelEdit()'
                                                        class="custom-btn bi bi-x mx-1"></span>
                                                </div>
                                            @endif
                                            @if ($editEquipmentType === true && $editTypeId != $data->id)
                                                <div class="">
                                                    <span class="custom-btn bi bi-pencil mx-1"
                                                        wire:click='editType({{ $data->id }})'></span>
                                                    <span wire:click='deleteType({{ $data->id }})'
                                                        class="custom-btn bi bi-trash mx-1"></span>
                                                </div>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                                @error('asset_type_id')
                                    <span class="text-danger fst-italic">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-5">
                                <x-form.textarea :label="'Mô tả loại tài sản'" :wire_model="'description'" :height="300" />
                            </div>
                        </div>

                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <x-button.previous :route="'admin.asset_type.list'"></x-button.previous>
                        <x-button.submit :text="'Thêm mới'" :class="'btn btn-success'"></x-button.submit>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
