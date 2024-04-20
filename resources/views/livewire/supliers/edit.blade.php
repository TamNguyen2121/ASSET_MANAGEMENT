<div>
    <div class="row">
        <div class="col-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Chỉnh sửa nhà cung cấp</h5>
                    <form wire:submit='updateSupplier'>
                        <div class="d-flex justify-content-between">
                            <div class="col-3">
                                <x-form.input :label="'Mã cung cấp'" :type="'text'" :wire_model="'code'"
                                    :error="'code'"></x-form.input>
                            </div>
                            <div class="col-3">
                                <x-form.input :label="'Tên nhà cung cấp'" :type="'text'" :wire_model="'name'"
                                    :error="'name'"></x-form.input>
                            </div>
                            <div class="col-3">
                                <x-form.input :label="'Só điện thoại'" :type="'text'" :wire_model="'phone_number'"
                                    :error="'phone_number'"></x-form.input>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="col-3">
                                <x-form.input :label="'Email'" :type="'text'" :wire_model="'email'"
                                    :error="'email'"></x-form.input>
                            </div>
                            <div class="col-3">
                                <x-form.input :label="'Mã số thuế'" :type="'text'" :wire_model="'tax'"
                                    :error="'tax'"></x-form.input>
                            </div>
                            <div class="col-3">
                                <x-form.input :label="'Địa chỉ'" :type="'text'" :wire_model="'address'"
                                    :error="'address'"></x-form.input>
                            </div>
                        </div>
                        <div class="">
                            <x-form.textarea :label="'Ghi chú'" :wire_model="'note'" :height="200" />
                        </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <x-button.previous :route="'admin.suplier.list'"></x-button.previous>
                        <x-button.submit :text="'Cập nhật'" :class="'btn btn-primary'"></x-button.submit>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
