<?php

namespace App\Livewire\Equipment;

use App\Models\Equipment;
use App\Models\EquipmentType;
use App\Models\supplier as Supplier;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use App\Models\User;
use Livewire\Attributes\Validate;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\EquipmentCategory;

#[Layout('layout.app.layout')]
#[Title('Chỉnh sửa tài sản')]
class Edit extends Component
{
    #[Validate()]
    public $equipment;
    public $equipment_type1;
    public $equipment_type_id;
    public $equipment_category_id;
    public $query;
    public $code;
    public $name_id;
    public $price;
    public $supplier_id;
    public $serial;
    public $use_status = 1;
    public $purchase_date;
    public $warranty_period;
    public $user_id;
    public $description;
    public $note;
    public $daysLeft;
    public $user_name;
    public $promissory_code;
    public $entry_code;
    public $user;

    public function mount($id)
    {
        $this->equipment = Equipment::find($id);
        if ($this->equipment) {
            $this->equipment_category_id = $this->equipment->name_id;
            $this->code = $this->equipment->code;
            $this->equipment_type_id = $this->equipment->equipment_type_id;
            $this->price = $this->equipment->price;
            $this->supplier_id = $this->equipment->supplier_id;
            $this->serial = $this->equipment->serial;
            $this->use_status = $this->equipment->use_status;
            $this->user_id = $this->equipment->user_id;
            $this->promissory_code = $this->equipment->promissory_code;
            $this->entry_code = $this->equipment->entry_code;
            $this->description = $this->equipment->description;
            $this->note = $this->equipment->note;
            $this->purchase_date = $this->equipment->purchase_date;
            $this->caculateDate();
            $this->user = $this->equipment->user_id;
            $this->query = User::find($this->user)->name;
            $purchase_date = Carbon::parse($this->purchase_date);
            $warranty_period = Carbon::parse($this->warranty_period);
            $this->daysLeft = $warranty_period->diffInDays($purchase_date);
        }
    }
    public function render()
    {
        return view('livewire.equipment.edit', [
            'suppliers' => Supplier::all(),
        ]);
    }
    #[On('updateUser')]
    public function updateUser($id)
    {
        $this->user_id = $id;
    }
    #[On('fillData')]
    public function fillUser($data)
    {
        $this->user_name = $data;
        $this->user_id = User::where('name', 'like', '%' . $this->user_name . '%')->pluck('id');
    }
    public function updateEquipment()
    {
        if ($validated = $this->validate()) {
            $user_id = $validated['user_id'][0] ?? $this->user_id;
            $this->equipment->update([
                'code' => $validated['code'],
                'name_id' => $this->equipment_category_id,
                'price' => $validated['price'],
                'supplier_id' => $validated['supplier_id'],
                'equipment_type_id' => $this->equipment_type_id,
                'serial' => $validated['serial'],
                'use_status' => $validated['use_status'],
                'purchase_date' => $validated['purchase_date'],
                'warranty_period' => $validated['warranty_period'],
                'user_id' => $user_id,
                'description' => $validated['description'],
                'promissory_code' => $validated['promissory_code'],
                'entry_code' => $validated['entry_code'],
                'status' => 1,
                'note' => $validated['note'],
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
    public function caculateDate()
    {
        $this->warranty_period = Carbon::parse($this->purchase_date)->addDays(360)->format('Y-m-d');
    }
    #[Computed()]
    public function equipmentType()
    {
        return EquipmentType::where('status', 1)->latest()->get();
    }
    #[Computed()]
    public function equipmentCategories()
    {
        return EquipmentCategory::where('status', 1)->where('equipment_type_id', $this->equipment_type_id)->latest()->get();
    }
    public function validationAttributes()
    {
        return [
            'code' => 'Mã tài sản',
            'equipment_category_id' => 'Tên tài sản',
            'price' => 'Giá',
            'supplier_id' => 'Nhà cung cấp',
            'equipment_type_id' => 'Loại tài sản',
            'serial' => 'Số seri',
            'use_status' => 'Trạng thái',
            'purchase_date' => 'Ngày mua',
            'warranty_period' => 'Hạn bảo hành',
            'user_id' => 'Người mua',
            'description' => 'Mô tả',
            'promissory_code' => 'Phiếu đề xuất',
            'entry_code' => 'Mã nhập',
            'note' => 'Ghi chú',
        ];
    }

    public function rules()
    {
        return [
            'code' => 'required|string|max:255|unique:equipment,code,' . $this->equipment->code . ',code',
            'equipment_category_id' => 'required|max:255',
            'price' => 'required|numeric',
            'supplier_id' => 'required|exists:suppliers,id',
            'equipment_type_id' => 'required',
            'serial' => 'required|string|max:255',
            'use_status' => 'required',
            'purchase_date' => 'required|date',
            'warranty_period' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'description' => 'nullable|string',
            'promissory_code' => 'required|string|max:255',
            'entry_code' => 'required|string|max:255',
            'note' => 'nullable|string',
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'unique' => ':attribute đã tồn tại.',
            'numeric' => ':attribute phải là số.',
            'min' => ':attribute phải lớn hơn :min.',
            'max' => ':attribute phải lớn hơn :max.'
        ];
    }
}
