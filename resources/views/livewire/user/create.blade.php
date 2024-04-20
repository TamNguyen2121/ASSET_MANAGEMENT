<div>
    <div class="row">
        <div class="col-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Thêm mới nhân viên</h5>
                    <form wire:submit.prevent='createUser'>
                        <div class="d-flex justify-content-between">
                            <div class="col-5">
                                <x-form.input :label="'Mã nhân viên'" :type="'text'" :wire_model="'code'"
                                    :error="'code'"></x-form.input>
                            </div>
                            <div class="col-5">
                                <x-form.input :label="'Họ và tên nhân viên'" :type="'text'" :wire_model="'name'"
                                    :error="'name'"></x-form.input>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="col-5">
                                <x-form.input :label="'Ngày sinh'" :type="'date'" :wire_model="'date_of_birth'"
                                    :error="'date_of_birth'"></x-form.input>
                            </div>
                            <div class="col-5">
                                <x-form.input :label="'CCCD'" :type="'text'" :wire_model="'identity_card'"
                                    :error="'identity_card'"></x-form.input>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="col-5">
                                <x-form.input :label="'Email'" :type="'text'" :wire_model="'email'"
                                    :error="'email'"></x-form.input>
                            </div>
                            <div class="col-5">
                                <x-form.input :label="'Địa chỉ'" :type="'text'" :wire_model="'address'"
                                    :error="'address'"></x-form.input>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="col-5">
                                <x-form.input :label="'Số điện thoại'" :type="'text'" :wire_model="'phone_number'"
                                    :error="'phone_number'"></x-form.input>
                            </div>
                            <div class="col-5">
                                <x-form.input :label="'Mã tài khoản'" :type="'text'" :wire_model="'account_code'"
                                    :error="'account_code'"></x-form.input>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="col-5">
                                <x-form.input :label="'Mật khẩu'" :type="'password'" :wire_model="'password'"
                                    :error="'password'"></x-form.input>
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <x-button.previous :route="'admin.user.list'"></x-button.previous>
                        <x-button.submit :text="'Thêm mới'" :class="'btn btn-success'"></x-button.submit>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
