<div>
    <div class="row">
        <div class="col-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Tìm kiếm loại tài sản</h5>
                    <div class="row">
                        <div class="col-12">
                            <div>
                                <form wire:submit='searchEquipmentCategory'>
                                    <div class="d-flex justify-content-between">
                                        <div class="col-5">
                                            <div class="mb-3">
                                                <x-form.input :label="'Mã loại tài sản'" :type="'text'" :wire_model="'code'"
                                                    :error="''" />
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <x-form.input :label="'Tên loại tài sản'" :type="'text'" :wire_model="'name'"
                                                :error="''" />
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="col-5">
                                            <x-form.select-option :label="'Kiểu thiết bị'" :wire_model="'equipment_type'" :options="$equipment_types"
                                                :error="''" />
                                        </div>
                                        <div class="col-5 ">
                                            <div class="mb-3">
                                                @livewire('user.user-search-bar')
                                            </div>
                                            <div class="d-flex float-end gap-3">
                                                <button wire:click.prevent='resetSearch'
                                                    class="btn btn-secondary border"><i class="ti ti-reload"></i>Đặt lại
                                                    bộ
                                                    lọc</button>
                                                <button class="btn btn-primary" type="submit"><i
                                                        class="ti ti-search"></i>Tìm
                                                    kiếm</button>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                        <div class="px-2 my-3">
                            <div class="border-bottom"></div>
                        </div>
                        <div class="col-12 mb-3 d-flex justify-content-between">
                            <div>
                                <h5 class="">Danh sách loại tài sản</h5>
                            </div>
                            <div class="d-flex gap-3">
                                <!-- <div class="btn-group">
                                    <button type="button" class="btn btn-info">Hành động</button>
                                    <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="visually-hidden">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <button wire:click.prevent='deleteAll()' class="dropdown-item">
                                                Xoá tất cả ({{ count($mySelect) }})
                                            </button>
                                        </li>
                                        <li>
                                            <button class="dropdown-item">
                                                Cập nhật hoạt động ({{ count($mySelect) }})
                                            </button>
                                        </li>
                                        <li>
                                            <button class="dropdown-item">
                                                Cập nhật không hoạt động ({{ count($mySelect) }})
                                            </button>
                                        </li>
                                    </ul>
                                </div> -->
                                <button wire:click.prevent='deleteAll()' class="btn btn-outline-danger">
                                    Xoá tất cả ({{ count($mySelect) }})
                                </button>
                                <x-button.create :route="'admin.equipment_type.create'" :name="'Thêm mới'"></x-button.create>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
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
                                        <h6 class="fw-semibold mb-0">Mã tài sản</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Tên loại tài sản</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Phân loại</h6>
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
                                @if (count($equipment_categories) > 0)
                                    @foreach ($equipment_categories as $index => $data)
                                        <tr>
                                            <td class="border-bottom-0">
                                                <input class="form-check-input mt-0" type="checkbox"
                                                    wire:model.live='mySelect' value="{{ $data->id }}"
                                                    wire:click.live="updateMySelect()">
                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">
                                                    {{ $equipment_categories->firstItem() + $index }}
                                                </h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><b>{{ $data->code }}</b></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><b>{{ $data->name }}</b></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><b>{{ $data->getEquipmentType() }}</b></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $data->created_at->format('d/m/Y') }}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $data->getUser() }}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <x-button.edit :route="'admin.equipment_type.edit'" :id="$data->id"></x-button.edit>
                                                <x-button.delete :action="'deleteEquipmentCategory'"
                                                    :id="$data->id"></x-button.delete>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="text-center">
                                        <td colspan="8">
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
                                    {{ $equipment_categories->links('Layout.app.livewire-pagination') }}
                                </div>
                                <span class="float-end">
                                    <h6>
                                        Hiển thị {{ $equipment_categories->firstItem() }} -
                                        {{ $equipment_categories->lastItem() }} của
                                        {{ $equipment_categories->total() }} kết quả
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
