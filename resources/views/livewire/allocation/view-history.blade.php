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
                        <h5 class="card-title fw-semibold mb-4">Lịch sử cấp phát</h5>
                    </div>
                    <div class="table-responsive ">
                        <table class="table text-nowrap mb-0 align-middle table-hover table-bordered">
                            <thead class="text-dark fs-4 bg-secondary-subtle">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">STT</h6>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Ngày cấp phát</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Đối tượng cấp phát</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Người nhận</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Tình trạng cấp phát</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Thao tác</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($allocations) > 0)
                                    @foreach ($allocations as $index => $data)
                                        <tr>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0 text-center">
                                                    {{ $allocations->firstItem() + $index }}
                                                </h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">
                                                    {{ $data->created_at->format('d/m/Y') }}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">
                                                    @if ($data->object == 0)
                                                        Cá nhân
                                                    @else
                                                        Tập thể
                                                    @endif
                                                </p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $data->getUser() }}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">
                                                    @if ($data->status == 1)
                                                        <span class="badge text-bg-success" style="width: 150px">Đang
                                                            cấp phát</span>
                                                    @else
                                                        <span class="badge text-bg-danger" style="width: 150px">Đã huỷ
                                                            cấp phát</span>
                                                    @endif
                                                </p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <x-button.view :route="'admin.allocation.view'" :id="$data->id" />
                                                @if ($data->status == 1)
                                                    <x-button.delete :action="'stopDispensing'" :id="$data->id"
                                                        :icon="'ti ti-minus'" />
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
                    <div class="py-2">
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
                                        {{ $allocations->links('Layout.app.livewire-pagination') }}
                                    </div>
                                    <span class="float-end">
                                        <h6>
                                            Hiển thị {{ $allocations->firstItem() }} - {{ $allocations->lastItem() }}
                                            của
                                            {{ $allocations->total() }} kết quả
                                        </h6>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex float-end">
                        <x-button.previous :route="'admin.allocation.history'"></x-button.previous>
                    </div>
                </div>
            </div>
        </div>
    </div>
