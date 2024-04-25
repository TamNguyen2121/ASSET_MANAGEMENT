<?php

namespace App\Livewire\Employee;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

#[Title('Thêm mới nhân viên')]
#[Layout('layout.app.layout')]
class Create extends Component
{
    #[Validate()]
    public $code;
    public $cccd;
    public $address;
    public $name;
    public $date_of_birth;
    public $identity_card;
    public $phone_number;
    public $user_name;
    public $status;
    public $email;
    public $password;

    public function render()
    {
        return view('livewire.employee.create');
    }

    public function createEmployee()
    {
        if ($validated = $this->validate()) {
            Employee::create([
                'code' => $validated['code'],
                'address' => $validated['address'],
                'name' => $validated['name'],
                'date_of_birth' => $validated['date_of_birth'],
                'identity_card' => $validated['identity_card'],
                'phone_number' => $validated['phone_number'],
                'user_name' => $validated['user_name'],
                'status' => 1,
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'created_by' => Auth::user()->id,
            ]);
            $this->dispatch(
                'alert',
                type: 'success',
                title: 'Thêm mới thành công',
                position: 'center',
                timer: 1500,
                confirm: false
            );
            $this->reset();
            return $this->redirectRoute('admin.employee.list');
        }
    }
    public function validationAttributes()
    {
        return [
            'code' => 'Mã nhân viên',
            'name' => 'Họ và tên nhân viên',
            'date_of_birth' => 'Ngày sinh',
            'identity_card' => 'CCCD',
            'email' => 'Email',
            'address' => 'Địa chỉ',
            'phone_number' => 'Số điện thoại',
            'user_name' => 'Tên đăng nhập',
            'password' => 'Mật khẩu',
        ];
    }
    public function rules()
    {
        return [
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'date_of_birth' => 'required|date_format:Y-m-d',
            'identity_card' => 'required|numeric|digits:12',
            'email' => 'required|unique:employee,email|email|max:255',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|numeric|digits_between:10,11',
            'user_name' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:6',
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute là bắt buộc.',
            'string' => ':attribute phải là một chuỗi ký tự.',
            'max' => ':attribute không được vượt quá :max ký tự.',
            'date_format' => ':attribute không đúng định dạng Y-m-d.',
            'numeric' => ':attribute phải là một số.',
            'digits' => ':attribute phải có :digits chữ số.',
            'email' => ':attribute phải là một địa chỉ email hợp lệ.',
            'digits_between' => ':attribute phải có từ :min đến :max chữ số.',
            'min' => ':attribute phải ít nhất :min ký tự.',
            'unique' => ':attribute đã được sử dụng'
        ];
    }
}
