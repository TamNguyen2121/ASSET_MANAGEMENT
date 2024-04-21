<div>
    <div class="row">
        <div class="col-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Danh sách nhà cung cấp</h5>
                    <div class="row d-flex">
                        <div class="col-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-light border border-end-0">
                                    <i class="ti ti-search"></i>
                                </span>
                                <input type="text" class="form-control border border-start-0"
                                    placeholder="Tìm tên nhà sản xuất" wire:model.live='name'>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex gap-3 float-end">
                                <button wire:click.prevent='deleteAll()' class="btn btn-outline-danger">
                                    Xoá tất cả ({{ count($mySelect) }})
                                </button>
                                <x-button.create :route="'admin.suplier.create'" :name="'Thêm mới'"></x-button.create>
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
                                            value="{{$suppliers[0] ? $suppliers[0]->id : null }}">

                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">STT</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Mã nhà cung cấp</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Tên nhà cung cấp</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Số điện thoại</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Người cập nhật</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Thời gian cập nhật</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Thao tác</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($suppliers as $index => $data)
                                    <tr>
                                        <td class="border-bottom-0">
                                            <input class="form-check-input mt-0" type="checkbox"
                                                wire:model.live='mySelect' value="{{ $data->id }}"
                                                wire:click.live="updateMySelect()">
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class=" mb-0">
                                                {{ $suppliers->firstItem() + $index }}
                                            </h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class=" mb-1">{{ $data->code }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class=" mb-1">{{ $data->name }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{ $data->phone_number }}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{ $data->getUser() }}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{ optional($data->updated_at)->format('d/m/Y') }}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <x-button.edit :route="'admin.suplier.edit'" :id="$data->id"></x-button.edit>
                                            <x-button.delete :action="'deleteSupplier'" :id="$data->id"></x-button.delete>
                                        </td>
                                    </tr>
                                @endforeach
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
                                    {{ $suppliers->links('Layout.app.livewire-pagination') }}
                                </div>
                                <span class="float-end">
                                    <h6>
                                        Hiển thị {{ $suppliers->firstItem() }} - {{ $suppliers->lastItem() }} của
                                        {{ $suppliers->total() }} kết quả
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
