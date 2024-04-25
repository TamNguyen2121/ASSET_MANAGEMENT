<?php

namespace App\Livewire\Suplier;

use App\Models\supplier;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

#[Layout('layout.app.layout')]
#[Title('Thêm mới nhà cung cấp')]

class Create extends Component
{
    #[Validate()]
    public $name;
    public $code;
    public $address;
    public $tax_code;
    public $email;
    public $note;
    public $status = 1;
    public $phone_number;
    public function render()
    {
        return view('livewire.suplier.create');
    }

    public function createSupplier()
    {
        if ($validate = $this->validate()) {
            supplier::create([
                'name' => $validate['name'],
                'code' => $validate['code'],
                'address' => $validate['address'],
                'phone_number' => $validate['phone_number'],
                'tax_code' => $this->tax_code,
                'email' => $this->email,
                'note' => $this->note,
                'status' => 1,
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
            return $this->redirectRoute('admin.suplier.list');
        }
    }
    public function rules()
    {
        return [
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'status' => 'required|integer|in:0,1',
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute không được để trống.',
            'string' => ':attribute phải là chuỗi.',
            'max' => ':attribute không được vượt quá :max ký tự.',
            'integer' => ':attribute phải là số nguyên.',
            'in' => ':attribute phải là một trong các giá trị sau: :values.',
        ];
    }
    public function validationAttributes()
    {
        return [
            'code' => 'Mã',
            'name' => 'Tên',
            'address' => 'Địa chỉ',
            'phone_number' => 'Số điện thoại',
            'status' => 'Trạng thái',
            'created_by' => 'Người tạo',
            'updated_by' => 'Người cập nhật',
            'tax_code' => 'Mã số thuế',
            'note' => 'Ghi chú'
        ];
    }
}
