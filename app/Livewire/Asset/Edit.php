<?php

namespace App\Livewire\Asset;

use App\Models\Asset;
use App\Models\AssetType;
use App\Models\supplier as Supplier;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use App\Models\Employee;
use Livewire\Attributes\Validate;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\AssetCategory;

#[Layout('layout.app.layout')]
#[Title('Chỉnh sửa tài sản')]
class Edit extends Component
{
    #[Validate()]
    public $equipment;
    public $equipment_type1;
    public $asset_type_id;
    public $asset_category_id;
    public $query;
    public $code;
    public $price;
    public $supplier_id;
    public $serial;
    public $use_status = 1;
    public $purchase_date;
    public $warranty_period;
    public $employee_id;
    public $asset_description;
    public $note;
    public $daysLeft;
    public $user_name;
    public $promissory_code;
    public $entry_code;
    public $user;

    public function mount($id)
    {
        $this->equipment = Asset::find($id);
        if ($this->equipment) {
            $this->asset_category_id = $this->equipment->asset_category_id;
            $this->code = $this->equipment->code;
            $this->asset_type_id = $this->equipment->asset_type_id;
            $this->price = $this->equipment->price;
            $this->supplier_id = $this->equipment->supplier_id;
            $this->serial = $this->equipment->serial;
            $this->use_status = $this->equipment->use_status;
            $this->employee_id = $this->equipment->employee_id;
            $this->promissory_code = $this->equipment->promissory_code;
            $this->entry_code = $this->equipment->entry_code;
            $this->asset_description = $this->equipment->asset_description;
            $this->note = $this->equipment->note;
            $this->purchase_date = $this->equipment->purchase_date;
            $this->caculateDate();
            $this->user = $this->equipment->employee_id;
            $this->query = Employee::find($this->user)->name;
            $purchase_date = Carbon::parse($this->purchase_date);
            $warranty_period = Carbon::parse($this->warranty_period);
            $this->daysLeft = $warranty_period->diffInDays($purchase_date);
        }
    }
    public function render()
    {
        return view('livewire.asset.edit', [
            'suppliers' => Supplier::all(),
        ]);
    }
    #[On('updateUser')]
    public function updateUser($id)
    {
        $this->employee_id = $id;
    }
    #[On('fillData')]
    public function fillUser($data)
    {
        $this->user_name = $data;
        $this->employee_id = Employee::where('name', 'like', '%' . $this->user_name . '%')->pluck('id');
    }
    public function updateEquipment()
    {
        if ($validated = $this->validate()) {
            $employee_id = $validated['employee_id'][0] ?? $this->employee_id;
            $this->equipment->update([
                'code' => $validated['code'],
                'asset_category_id' => $this->asset_category_id,
                'price' => $validated['price'],
                'supplier_id' => $validated['supplier_id'],
                'asset_type_id' => $this->asset_type_id,
                'serial' => $validated['serial'],
                'use_status' => $validated['use_status'],
                'purchase_date' => $validated['purchase_date'],
                'warranty_period' => $validated['warranty_period'],
                'employee_id' => $employee_id,
                'asset_description' => $validated['asset_description'],
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
        return AssetType::where('status', 1)->latest()->get();
    }
    #[Computed()]
    public function equipmentCategories()
    {
        return AssetCategory::where('status', 1)->where('asset_type_id', $this->asset_type_id)->latest()->get();
    }
    public function validationAttributes()
    {
        return [
            'code' => 'Mã tài sản',
            'asset_category_id' => 'Tên tài sản',
            'price' => 'Giá',
            'supplier_id' => 'Nhà cung cấp',
            'asset_type_id' => 'Loại tài sản',
            'serial' => 'Số seri',
            'use_status' => 'Trạng thái',
            'purchase_date' => 'Ngày mua',
            'warranty_period' => 'Hạn bảo hành',
            'employee_id' => 'Người mua',
            'asset_description' => 'Mô tả',
            'promissory_code' => 'Phiếu đề xuất',
            'entry_code' => 'Mã nhập',
            'note' => 'Ghi chú',
        ];
    }

    public function rules()
    {
        return [
            'code' => 'required|string|max:255|unique:asset,code,' . $this->equipment->code . ',code',
            'asset_category_id' => 'required|max:255',
            'price' => 'required|numeric',
            'supplier_id' => 'required|exists:suppliers,id',
            'asset_type_id' => 'required',
            'serial' => 'required|string|max:255',
            'use_status' => 'required',
            'purchase_date' => 'required|date',
            'warranty_period' => 'required|date',
            'employee_id' => 'required|exists:employee,id',
            'asset_description' => 'nullable|string',
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
