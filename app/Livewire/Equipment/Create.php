<?php

namespace App\Livewire\Equipment;

use App\Models\Equipment;
use App\Models\EquipmentType;
use App\Models\supplier as Supplier;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use App\Models\User;
use Livewire\Attributes\Validate;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\EquipmentCategory;
use Livewire\Attributes\Computed;

#[Layout('layout.app.layout')]
#[Title('Thêm mới tài sản')]
class Create extends Component
{
    #[Validate()]
    public $equipment_category_id;
    public $equipment_type_id;
    public $code;
    public $price;
    public $producer;
    public $supplier_id;
    public $serial;
    public $use_status = 1;
    public $purchase_date;
    public $warranty_period;
    public $user_id;
    public $description;
    public $note;
    public $daysLeft = 360;
    public $user_name;
    public $promissory_code;
    public $entry_code;

    public function mount()
    {
        $this->purchase_date = now()->format('Y-m-d');
        $this->caculateDate();
    }
    public function render()
    {
        return view('livewire.equipment.create', [
            'suppliers' => Supplier::all(),
        ]);
    }
    public function caculateDate()
    {
        $this->warranty_period = Carbon::parse($this->purchase_date)->addDays(360)->format('Y-m-d');
    }
    public function createEquipment()
    {
        if ($validated = $this->validate()) {
            $user_id = $validated['user_id'][0];
            Equipment::create([
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
            $this->afterSuccess();
        }
    }
    public function afterSuccess()
    {
        $this->code = '';
        $this->price = '';
        $this->supplier_id = '';
        $this->equipment_type_id = '';
        $this->serial = '';
        $this->use_status = '';
        $this->purchase_date = now()->format('Y-m-d');
        $this->warranty_period = Carbon::parse($this->purchase_date)->addDays(360)->format('Y-m-d');
        $this->user_id = '';
        $this->description = '';
        $this->promissory_code = '';
        $this->entry_code = '';
        $this->note = '';
        $this->user_name = '';
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
    public function updatedEquipmentTypeId()
    {
        $this->equipment_category_id = null;
    }
    public function validationAttributes()
    {
        return [
            'code' => 'Mã tài sản',
            'name' => 'Tên tài sản',
            'price' => 'Giá',
            'supplier_id' => 'Nhà cung cấp',
            'equipment_type_id' => 'Kiểu tài sản',
            'serial' => 'Số seri',
            'use_status' => 'Trạng thái',
            'purchase_date' => 'Ngày mua',
            'warranty_period' => 'Hạn bảo hành',
            'user_id' => 'Người mua',
            'description' => 'Mô tả',
            'promissory_code' => 'Phiếu đề xuất',
            'entry_code' => 'Mã nhập',
            'note' => 'Ghi chú',
            'equipment_category_id' => 'Tên tài sản'
        ];
    }
    public function rules()
    {
        return [
            'code' => 'required|string|max:255|unique:equipment,code',
            'price' => 'required|numeric',
            'supplier_id' => 'required',
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
            'equipment_category_id' => 'required'
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
