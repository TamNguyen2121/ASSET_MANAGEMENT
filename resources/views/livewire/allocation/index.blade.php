<div class="mt-1">
    <nav class="nav nav-pills flex-column flex-sm-row bg-white rounded">
        <a class="flex-sm-fill text-sm-center nav-link active" href="{{ route('admin.allocation.list') }}" wire:navigate>
            Tài sản chưa cấp phát
        </a>
        <a class="flex-sm-fill text-sm-center nav-link text-dark" href="{{ route('admin.allocation.issued') }}" wire:navigate>Tài
            sản đã cấp
            phát</a>
        <a class="flex-sm-fill text-sm-center nav-link text-dark" href="{{ route('admin.allocation.history') }}" wire:navigate>Lịch
            sử cấp
            phát</a>
    </nav>
    <div class="row mt-3">
        <div class="col-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Tìm kiếm loại thiết bị</h5>
                    <div class="row">
                        <div class="col-12">
                            <div>
                                <form wire:submit.prevent='searchEquipment'>
                                    <div class="d-flex justify-content-between">
                                        <div class="col-md-5">
                                            <div class="">
                                                <x-form.input :label="'Mã tài sản'" :type="'text'" :wire_model="'code'"
                                                    :error="''" />
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <x-form.input :label="'Tên tài sản'" :type="'text'" :wire_model="'name'"
                                                :error="''" />
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="col-5">
                                            <label class="form-label">Kiểu tài sản</label>
                                            <select class="form-select" wire:model='parent_id'>
                                                <option value=""></option>
                                                @foreach ($equipment_types as $data)
                                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-5">
                                            <label class="form-label">Trạng thái</label>
                                            <select class="form-select" wire:model='use_status'>
                                                <option value="">Tất cả</option>
                                                <option value="1">Tốt</option>
                                                <option value="0">Hỏng</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="d-flex float-end gap-3">
                                            <button wire:click.prevent='resetSearch' class="btn btn-secondary border">
                                                <i class="ti ti-reload"></i>Đặt lại bộ lọc</button>
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
                                <h5 class="">Danh sách loại thiết bị</h5>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive ">
                        <table class="table text-nowrap mb-0 align-middle table-hover table-bordered">
                            <thead class="text-dark fs-4 bg-secondary-subtle">
                                <tr>
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
                                                <h6 class="fw-semibold mb-0 text-center">
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
                                                <p class="mb-0 fw-normal text-success fw-bolder">{{ $data->price }}
                                                    VNĐ
                                                </p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $data->created_at->format('d/m/Y') }}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $data->getUser() }}</p>
                                            </td>

                                            <td class="border-bottom-0 text-center">
                                                @if ($data->use_status == 0)
                                                    <i
                                                        class="border ti ti-plus rounded p-1 me-1 bg-dark text-white"></i>
                                                @else
                                                    <x-button.allocation :id="$data->id" :route="'admin.allocation.create'" />
                                                @endif
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
