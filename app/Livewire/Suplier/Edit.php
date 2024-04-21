<?php

namespace App\Livewire\Suplier;

use App\Models\supplier;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Chỉnh sửa nhà cung cấp')]
#[Layout('layout.app.layout')]
class Edit extends Component
{
    #[Validate()]
    public $supplier;
    public $name;
    public $code;
    public $status;
    public $address;
    public $phone_number;
    public $tax_code;
    public $note;
    public $email;

    public function mount($id)
    {
        $this->supplier = supplier::find($id);
        if ($this->supplier) {
            $this->name = $this->supplier->name;
            $this->code = $this->supplier->code;
            $this->address = $this->supplier->address;
            $this->phone_number = $this->supplier->phone_number;
            $this->status = $this->supplier->status;
            $this->tax_code = $this->supplier->tax_code;
            $this->note = $this->supplier->note;
            $this->email = $this->supplier->email;
        }
    }
    public function render()
    {
        return view('livewire.suplier.edit');
    }

    public function updateSupplier()
    {
        if ($validate = $this->validate()) {
            $this->supplier->update([
                'name' => $validate['name'],
                'code' => $validate['code'],
                'address' => $validate['address'],
                'phone_number' => $validate['phone_number'],
                'tax_code' => $this->tax_code,
                'email' => $this->email,
                'note' => $this->note,
                'status' => 1,
                'updated_by' => Auth::user()->id,
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
        ];
    }
}
