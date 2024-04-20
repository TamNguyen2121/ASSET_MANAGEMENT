<div>
    <div class="row">
        <div class="col-12 d-flex align-items-stretch">
            <div class="card w-100">
                <h5 class="card-header fw-semibold mb-4">Cấp phát tài sản</h5>
                <div class="card-body p-3">
                    <div class="mx-2">
                        <h5 class="card-title fw-semibold mb-4">Thông tin tài sản</h5>
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="w-50">Thông tin</th>
                                <th class="w-50">Chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Mã tài sản</th>
                                <td>{{ $equipment->code }}</td>
                            </tr>
                            <tr>
                                <th>Tên tài sản</th>
                                <td>{{ $equipment->getEquipmentCategory() }}</td>
                            </tr>
                            <tr>
                                <th>Loại tài sản</th>
                                <td>{{ $equipment->getEquipmentType() }}</td>
                            </tr>
                            <tr>
                                <th>Hạn bảo hành</th>
                                <td>{{ date('d/m/Y', strtotime($equipment->warranty_period)) }}</td>
                            </tr>
                            <tr>
                                <th>Giá</th>
                                <td>{{ number_format($equipment->price, 0, ',', '.') }} VNĐ</td>
                            </tr>
                            <tr>
                                <th>Trạng thái</th>
                                <td>
                                    <h6 class="fw-semibold mb-1">
                                        @if ($equipment->use_status == 1)
                                            <span class="badge text-bg-success" style="width: 100px">Tốt</span>
                                        @elseif ($equipment->use_status == 0)
                                            <span class="badge text-bg-danger" style="width: 100px">Hỏng</span>
                                        @else
                                            <span class="badge text-bg-secondary" style="width: 100px">Đã
                                                thanh lý</span>
                                        @endif
                                    </h6>
                                </td>
                            </tr>
                            <tr>
                                <th>Mô tả</th>
                                <td>{{ $equipment->description }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="mx-2 my-2">
                        <h5 class="card-title fw-semibold mb-4">Thông tin cấp phát</h5>
                    </div>
                    <form wire:submit.prevent='createAllocation'>
                        <div class="d-flex justify-content-between mx-2">
                            <div class="col-5">
                                <label class="form-label">Đối tượng cấp phát</label>
                                <select class="form-select" wire:model='object'>
                                    <option selected value=""></option>
                                    <option value="0">Cá nhân</option>
                                    <option value="1">Tập thể</option>
                                </select>
                                @error('object')
                                    <span class="text-danger fst-italic">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-5">
                                @livewire('user.user-search-bar', ['label' => 'Người nhận'])
                                @error('user_id')
                                    <span class="text-danger fst-italic">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <x-button.previous :route="'admin.allocation.list'"></x-button.previous>
                        <x-button.submit :text="'Cấp phát'" :class="'btn btn-success'"></x-button.submit>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
