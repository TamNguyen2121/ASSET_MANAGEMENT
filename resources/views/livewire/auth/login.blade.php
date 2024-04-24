<div>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-more" style="background-image: url('{{asset('auth/images/bg.jpg')}}');">
                </div>
                <form class="login100-form validate-form" wire:submit="loginProcess">
                    <div style="display: flex;justify-content: center; padding-bottom:50px">
                        <img src="{{ asset('admin_dashbroad/assets/images/logos/logo-light.jpg') }}" width="300px" alt="" />
                    </div>
                    <span class="login100-form-title p-b-43">
                        Đăng nhập
                    </span>
                    <div class="mb-3">
                        <label class="form-label">Tài khoản</label>
                        <input class="form-control p-3" type="text" wire:model='user_name'>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mật khẩu</label>
                        <input class="form-control p-3" type="password" wire:model='password'>
                    </div>
                    <div class="mb-3 text-center">
                        <a href="#">Quên mật khẩu</a>
                    </div>
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" type="submit">
                            Đăng nhập
                        </button>
                    </div>
                    @if ($show == true)
                    <div class="alert alert-danger mt-3" role="alert">
                        <div class="d-flex justify-content-between">
                            <div class="">{{ $errors }}</div>
                            <div class="">
                                <i class="bi bi-x" wire:click='closeAlert()'></i>
                            </div>
                        </div>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>

