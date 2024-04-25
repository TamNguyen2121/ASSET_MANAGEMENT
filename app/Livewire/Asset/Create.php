<?php

namespace App\Livewire\Asset;

use App\Models\Asset;
use App\Models\AssetCategory;
use App\Models\AssetType;
use App\Models\supplier as Supplier;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use App\Models\Employee;
use Livewire\Attributes\Validate;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;

#[Layout('layout.app.layout')]
#[Title('Thêm mới tài sản')]
class Create extends Component
{
    #[Validate()]
    public $asset;
    public $asset_category_id;
    public $asset_type_id;
    public $code;
    public $price;
    public $producer;
    public $supplier_id;
    public $serial;
    public $use_status = 1;
    public $purchase_date;
    public $warranty_period;
    public $employee_id;
    public $asset_description;
    public $note;
    public $daysLeft = 360;
    public $user_name;
    public $promissory_code;
    public $entry_code;
    public $query;
    public $user;
    public $copy;

    public function mount()
    {
        $this->purchase_date = $this->caculateDate();
        $this->copy = request()->query();
        if(isset($this->copy['id'])){
            $this->asset = Asset::find($this->copy['id']);
            $this->asset_category_id = $this->asset->asset_category_id;
            $this->asset_type_id = $this->asset->asset_type_id;
            $this->price = $this->asset->price;
            $this->supplier_id = $this->asset->supplier_id;
            $this->serial = $this->asset->serial;
            $this->use_status = $this->asset->use_status;
            $this->employee_id = $this->asset->employee_id;
            $this->promissory_code = $this->asset->promissory_code;
            $this->entry_code = $this->asset->entry_code;
            $this->asset_description = $this->asset->asset_description;
            $this->note = $this->asset->note;
            $this->purchase_date = $this->asset->purchase_date;
            $this->warranty_period = $this->caculateDate();
            $this->user = $this->asset->employee_id;
            $this->query = Employee::find($this->user)->name;
            $purchase_date = Carbon::parse($this->purchase_date);
            $warranty_period = Carbon::parse($this->warranty_period);
            $this->daysLeft = $warranty_period->diffInDays($purchase_date);
        }

    }
    public function render()
    {
        return view('livewire.asset.create', [
            'suppliers' => Supplier::all(),
            'asset_copy' => isset($asset) ? $asset : false
        ]);
    }
    public function caculateDate()
    {
        return Carbon::parse($this->purchase_date)->addDays(360)->format('Y-m-d');
    }
    public function createEquipment()
    {
        if ($validated = $this->validate()) {
            $employee_id = $validated['employee_id'][0];
            Asset::create([
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
            return $this->redirectRoute('admin.asset.list');
        }
    }
    public function afterSuccess()
    {
        $this->code = '';
        $this->price = '';
        $this->supplier_id = '';
        $this->asset_type_id = '';
        $this->serial = '';
        $this->use_status = '';
        $this->purchase_date = now()->format('Y-m-d');
        $this->warranty_period = Carbon::parse($this->purchase_date)->addDays(360)->format('Y-m-d');
        $this->employee_id = '';
        $this->asset_description = '';
        $this->promissory_code = '';
        $this->entry_code = '';
        $this->note = '';
        $this->user_name = '';
        
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
    public function updatedEquipmentTypeId()
    {
        $this->asset_category_id = null;
    }
    public function validationAttributes()
    {
        return [
            'code' => 'Mã tài sản',
            'name' => 'Tên tài sản',
            'price' => 'Giá',
            'supplier_id' => 'Nhà cung cấp',
            'asset_type_id' => 'Kiểu tài sản',
            'serial' => 'Số seri',
            'use_status' => 'Trạng thái',
            'purchase_date' => 'Ngày mua',
            'warranty_period' => 'Hạn bảo hành',
            'employee_id' => 'Người mua',
            'asset_description' => 'Mô tả',
            'promissory_code' => 'Phiếu đề xuất',
            'entry_code' => 'Mã nhập',
            'note' => 'Ghi chú',
            'asset_category_id' => 'Tên tài sản'
        ];
    }
    public function rules()
    {
        return [
            'code' => 'required|string|max:255|unique:asset,code',
            'price' => 'required|numeric',
            'supplier_id' => 'required',
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
            'asset_category_id' => 'required'
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
