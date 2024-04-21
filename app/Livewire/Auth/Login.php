<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;



#[Layout('layout.auth.auth')]
#[Title('Đăng nhập')]
class Login extends Component
{
    public $user_name;
    public $password;
    public $errors;
    public $show = false;

    public function render()
    {
        return view('livewire.auth.login');
    }

    public function loginProcess()
    {
        if ($this->user_name == '' || $this->password == '') {
            $this->errors = "Không để trống thông tin";
            $this->show = true;
        } else {
            if (Auth::attempt(['user_name' => $this->user_name, 'password' => $this->password])) {
                return redirect()->route('admin.home');
            } else {
                $this->errors = "Sai tài khoản hoặc mật khẩu";
                $this->show = true;
            }
        }
    }
    
    public function closeAlert()
    {
        if ($this->show == true) {
            $this->show = false;
        }
    }
}
