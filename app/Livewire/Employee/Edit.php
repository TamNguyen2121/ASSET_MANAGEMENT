<?php

namespace App\Livewire\Employee;

use App\Models\Employee;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

#[Title('Chỉnh sửa nhân viên')]
#[Layout('layout.app.layout')]
class Edit extends Component
{
    #[Validate()]
    public $employee;
    public $code;
    public $address;
    public $name;
    public $date_of_birth;
    public $identity_card;
    public $phone_number;
    public $user_name;
    public $status;
    public $email;

    public function mount($id)
    {
        $this->employee = Employee::find($id);
        if ($this->employee) {
            $this->code = $this->employee->code;
            $this->identity_card = $this->employee->identity_card;
            $this->address = $this->employee->address;
            $this->name = $this->employee->name;
            $this->date_of_birth = $this->employee->date_of_birth;
            $this->phone_number = $this->employee->phone_number;
            $this->user_name = $this->employee->user_name;
            $this->status = $this->employee->status;
            $this->email = $this->employee->email;
        }
    }
    public function render()
    {
        return view('livewire.employee.edit');
    }

    public function updateUser()
    {
        if ($validated = $this->validate()) {
            $this->employee->update([
                'name' => $validated['name'],
                'code' => $validated['code'],
                'user_name' => $validated['user_name'],
                'date_of_birth' => $validated['date_of_birth'],
                'identity_card' => $validated['identity_card'],
                'address' => $validated['address'],
                'phone_number' => $validated['phone_number'],
                'status' => $this->status,
            ]);
            $this->dispatch(
                'alert',
                type: 'info',
                title: 'Cập nhật thành công',
                position: 'center',
                timer: 1500,
                confirm: false
            );
        }
    }
    public function validationAttributes()
    {
        return [
            'code' => 'Mã nhân viên',
            'name' => 'Họ và tên nhân viên',
            'date_of_birth' => 'Ngày sinh',
            'identity_card' => 'CCCD',
            'address' => 'Địa chỉ',
            'phone_number' => 'Số điện thoại',
            'user_name' => 'Tên đăng nhập',
        ];
    }
    public function rules()
    {
        return [
            'code' => 'required|string|max:255|unique:employee,code,' . $this->employee->id,
            'name' => 'required|string|max:255',
            'date_of_birth' => 'required|date_format:Y-m-d',
            'identity_card' => 'required|numeric|digits:12',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|numeric|digits_between:10,11',
            'user_name' => 'required|string|max:255',
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
            'digits_between' => ':attribute phải có từ :min đến :max chữ số.',
            'min' => ':attribute phải ít nhất :min ký tự.',
            'unique' => ':attribute đã được sử dụng'
        ];
    }
}
