<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

#[Title('Chỉnh sửa nhân viên')]
#[Layout('layout.app.layout')]
class Edit extends Component
{
    #[Validate()]
    public $user;
    public $code;
    public $address;
    public $name;
    public $date_of_birth;
    public $identity_card;
    public $phone_number;
    public $account_code;
    public $status;
    public $email;

    public function mount($id)
    {
        $this->user = User::find($id);
        if ($this->user) {
            $this->code = $this->user->code;
            $this->identity_card = $this->user->identity_card;
            $this->address = $this->user->address;
            $this->name = $this->user->name;
            $this->date_of_birth = $this->user->date_of_birth;
            $this->phone_number = $this->user->phone_number;
            $this->account_code = $this->user->account_code;
            $this->status = $this->user->status;
            $this->email = $this->user->email;
        }
    }
    public function render()
    {
        return view('livewire.user.edit');
    }

    public function updateUser()
    {
        if ($validated = $this->validate()) {
            $this->user->update([
                'name' => $validated['name'],
                'code' => $validated['code'],
                'account_code' => $validated['account_code'],
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
            'account_code' => 'Mã tài khoản',
        ];
    }
    public function rules()
    {
        return [
            'code' => 'required|string|max:255|unique:users,code,' . $this->user->id,
            'name' => 'required|string|max:255',
            'date_of_birth' => 'required|date_format:Y-m-d',
            'identity_card' => 'required|numeric|digits:12',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|numeric|digits_between:10,11',
            'account_code' => 'required|string|max:255',
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
