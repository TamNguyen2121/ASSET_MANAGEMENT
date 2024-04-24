<div>
    <div class="row">
        <div class="col-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Tìm kiếm tài sản</h5>
                    <div class="row">
                        <div class="col-12">
                            <div>
                                <form wire:submit='searchEquipment'>
                                    <div class="d-flex justify-content-between">
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <x-form.input :label="'Mã tài sản'" :type="'text'" :wire_model="'code'"
                                                    :error="''" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <x-form.input :label="'Tên tài sản'" :type="'text'" :wire_model="'name'"
                                                :error="''" />
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Kiểu tài sản</label>
                                            <select class="form-select" wire:model="asset_type_id">
                                                <option selected></option>
                                                @foreach ($asset_type as $data)
                                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="col-3">
                                            <label class="form-label">Trạng thái</label>
                                            <select class="form-select" wire:model='use_status'>
                                                <option value="">Tất cả</option>
                                                <option value="1">Tốt</option>
                                                <option value="0">Hỏng</option>
                                                <option value="2">Đã thanh lý</option>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label for="exampleInputEmail1" class="form-label">Ngày tạo</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text border">Từ</span>
                                                <input type="date" class="form-control" wire:model='startDate'>
                                                <span class="input-group-text border">đến</span>
                                                <input type="date" class="form-control" wire:model='endDate'>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="mb-3">
                                                @livewire('employee.employee-search-bar', [])
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex float-end gap-3">
                                        <button wire:click.prevent='resetSearch' class="btn btn-secondary border">
                                            <i class="ti ti-reload"></i>Đặt lại bộ lọc</button>
                                        <button class="btn btn-primary" type="submit"><i class="ti ti-search"></i>Tìm
                                            kiếm</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="px-2 my-3">
                            <div class="border-bottom"></div>
                        </div>
                        <div class="col-12 mb-3 d-flex justify-content-between">
                            <div>
                                <h5 class="">Danh sách tài sản</h5>
                            </div>
                            <div class="d-flex gap-3">
                                <button wire:click.prevent='deleteAll()' class="btn btn-outline-danger">
                                    Xoá tất cả ({{ count($mySelect) }})
                                </button>
                                <x-button.create :route="'admin.asset.create'" :name="'Nhập tài sản'"></x-button.create>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive ">
                        <table class="table text-nowrap mb-0 align-middle table-hover table-bordered">
                            <thead class="text-dark fs-4 bg-secondary-subtle">
                                <tr>
                                    <th class="border-bottom-0">
                                        <input class="form-check-input mt-0" type="checkbox" wire:model.live='selectAll'
                                            wire:click.live="updateSelectAll()">
                                        <input class="form-check-input mt-0" type="hidden" wire:model.live='firstId'
                                            value="{{ $firstId }}">

                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">STT</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Trạng thái</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Mã tài sản</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Tên tài sản</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Kiểu tài sản</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Giá</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Ngày tạo</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Người tạo</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Thao tác</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($equipments) > 0)
                                    @foreach ($equipments as $index => $data)
                                        <tr>
                                            <td class="border-bottom-0">
                                                <input class="form-check-input mt-0" type="checkbox"
                                                    wire:model.live='mySelect' value="{{ $data->id }}"
                                                    wire:click.live="updateMySelect()">
                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">
                                                    {{ $equipments->firstItem() + $index }}
                                                </h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-1">
                                                    @if ($data->use_status == 1)
                                                        <span class="badge text-bg-success"
                                                            style="width: 100px">Tốt</span>
                                                    @elseif ($data->use_status == 0)
                                                        <span class="badge text-bg-danger"
                                                            style="width: 100px">Hỏng</span>
                                                    @else
                                                        <span class="badge text-bg-secondary" style="width: 100px">Đã
                                                            thanh lý</span>
                                                    @endif
                                                </h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-1">{{ $data->code }}</h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-1">{{ $data->getEquipmentCategory() }}</h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $data->getEquipmentType() }}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal text-success fw-bolder">{{  number_format($data->price, 0, ',', '.') }}
                                                    VNĐ
                                                </p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $data->created_at->format('d/m/Y') }}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $data->getUser() }}</p>
                                            </td>

                                            <td class="border-bottom-0">
                                                <x-button.copy :route="'admin.asset.create'" :id="$data->id" />
                                                <x-button.edit :route="'admin.asset.edit'" :id="$data->id" />
                                                <x-button.delete :action="'deleteEquipment'" :id="$data->id" />
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="text-center">
                                        <td colspan="10">
                                            Không có dữ liệu
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="py-1 px-1">
                        <div class="d-flex justify-content-between">
                            <div class="flex space-x-4 items-center">
                                <label class="w-32 text-sm font-medium text-gray-900">Hiển thị : </label>
                                <select wire:model.live='page'
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <div class="flex space-x-4 items-center">
                                <div class="flex items-center">
                                    {{ $equipments->links('Layout.app.livewire-pagination') }}
                                </div>
                                <span class="float-end">
                                    <h6>
                                        Hiển thị {{ $equipments->firstItem() }} - {{ $equipments->lastItem() }} của
                                        {{ $equipments->total() }} kết quả
                                    </h6>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
