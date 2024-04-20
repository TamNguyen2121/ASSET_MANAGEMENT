<div>
    <div class="row">
        <div class="col-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Thông tin tài sản</h5>
                    <form wire:submit.prevent='createEquipment'>
                        <div class="d-flex justify-content-between">
                            <div class="col-5">
                                <x-form.input :label="'Mã tài sản'" :type="'text'" :wire_model="'code'"
                                    :error="'code'"></x-form.input>
                            </div>
                            <div class="col-5">
                                <label class="form-label">Tên tài sản</label>
                                <select class="form-select" wire:model="equipment_category_id">
                                    <option selected></option>
                                    @foreach ($this->equipmentCategories as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                                @error('equipment_category_id')
                                    <span class="text-danger fst-italic">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <div class="col-5">
                                <label class="form-label">Kiểu tài sản</label>
                                <select class="form-select" wire:model.live="equipment_type_id">
                                    <option selected></option>
                                    @foreach ($this->equipmentType as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                                @error('equipment_type_id')
                                    <span class="text-danger fst-italic">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-5">
                                <label class="form-label">Trạng thái</label>
                                <select class="form-select" disabled wire:model='use_status'>
                                    <option value="1">Tốt</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="col-5">
                                <x-form.input :label="'Số seri'" :type="'text'" :wire_model="'serial'"
                                    :error="'serial'"></x-form.input>
                            </div>
                            <div class="col-5">
                                <div class="d-flex justify-content-between">
                                    <div class="col-6">
                                        <label class="form-label">Hạn bảo hành</label>
                                        <input type="date" class="form-control" disabled
                                            wire:model='warranty_period'>
                                    </div>
                                    <div class="col-5">
                                        <label class="form-label">Thời hạn bảo hành (Ngày)</label>
                                        <input type="text" class="form-control" wire:model='daysLeft' disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h5 class="card-title fw-semibold mb-4">Thông tin đặt hàng</h5>
                        <div class="d-flex justify-content-between mb-3">
                            <div class="col-5">
                                @livewire('user.user-search-bar', ['label' => 'Người mua'])
                                @error('user_id')
                                    <span class="text-danger fst-italic">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-5">
                                <label class="form-label">Ngày mua</label>
                                <input type="date" class="form-control" wire:model='purchase_date'
                                    wire:change='caculateDate()'>
                                @error('purchase_date')
                                    <span class="text-danger fst-italic">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="col-5">
                                <x-form.input :label="'Giá'" :type="'text'" :wire_model="'price'"
                                    :error="'price'"></x-form.input>
                            </div>
                            <div class="col-5">
                                <x-form.select-option :label="'Nhà cung cấp'" :wire_model="'supplier_id'" :options="$suppliers"
                                    :error="'supplier_id'" />
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="col-5">
                                <x-form.input :label="'Phiếu đề xuất'" :type="'text'" :wire_model="'promissory_code'"
                                    :error="'promissory_code'"></x-form.input>
                            </div>
                            <div class="col-5">
                                <x-form.input :label="'Mã nhập'" :type="'text'" :wire_model="'entry_code'"
                                    :error="'entry_code'"></x-form.input>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="col-5">
                                <x-form.textarea :label="'Miêu tả'" :wire_model="'description'" :height="200" />
                            </div>
                            <div class="col-5">
                                <x-form.textarea :label="'Ghi chú'" :wire_model="'note'" :height="200" />
                            </div>
                        </div>
                </div>
                {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <x-button.previous :route="'admin.equipment.list'"></x-button.previous>
                        <x-button.submit :text="'Thêm mới'" :class="'btn btn-success'"></x-button.submit>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
