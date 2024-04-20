<div>
    <div class="row">
        <div class="col-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Danh sách nhân viên</h5>
                    <div class="row d-flex">
                        <div class="col-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-light border border-end-0">
                                    <i class="ti ti-search"></i>
                                </span>
                                <input type="text" class="form-control border border-start-0"
                                    placeholder="Nhập họ tên, tên đăng nhập" wire:model.live='name'>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex gap-3 float-end">
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
                                <x-button.create :route="'admin.user.create'" :name="'Thêm mới'"></x-button.create>
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
                                            value="{{ $users->isNotEmpty() ? $users->first()->id : null }}">
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">STT</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Mã nhân viên</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Họ và tên</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Tên đăng nhập</h6>
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
                                    @foreach ($users as $index => $data)
                                        <tr>
                                            <td class="border-bottom-0">
                                                <input class="form-check-input mt-0" type="checkbox"
                                                    wire:model.live='mySelect' value="{{ $data->id }}"
                                                    wire:click.live="updateMySelect()">
                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">
                                                    {{ $users->firstItem() + $index }}
                                                </h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $data->code }}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-normal mb-1">{{ $data->name }}</h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $data->email }}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $data->getUser() }}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $data->updated_at->format('d/m/Y') }}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <x-button.edit :route="'admin.user.edit'" :id="$data->id"></x-button.edit>
                                                <x-button.delete :action="'deleteUser'" :id="$data->id"></x-button.delete>
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
                                    {{ $users->links('Layout.app.livewire-pagination') }}
                                </div>
                                <span class="float-end">
                                    <h6>
                                        Hiển thị {{ $users->firstItem() }} - {{ $users->lastItem() }} của
                                        {{ $users->total() }} kết quả
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
