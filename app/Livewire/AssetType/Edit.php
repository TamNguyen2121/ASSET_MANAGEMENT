<?php

namespace App\Livewire\AssetType;

use App\Models\AssetCategory;
use App\Models\AssetType;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;

#[Layout('layout.app.layout')]
#[Title('Chỉnh sửa loại thiết bị')]
class Edit extends Component
{
    #[Validate()]
    public $equipment_category;
    public $name;
    public $description;
    public $status;
    public $asset_type_id;
    public $editEquipmentType = false;
    public $label = "Chỉnh sửa kiểu tài sản";
    public $class = "btn btn-primary";
    public $editTypeId = '';
    public $editTypeName;
    public $addNewStatus = false;
    public $newType;
    public $code;


    public function mount($id)
    {
        if ($this->equipment_category = AssetCategory::find($id)) {
            $this->code = $this->equipment_category->code;
            $this->name = $this->equipment_category->name;
            $this->asset_type_id = $this->equipment_category->asset_type_id;
            $this->description = $this->equipment_category->description;
            $this->status = $this->equipment_category->status;
        }
    }
    public function render()
    {
        return view('livewire.asset-type.edit', [
            'asset_type' => AssetType::where('status', 1)->latest()->get()
        ]);
    }
    public function updateEquipmentCategory()
    {
        if ($validated = $this->validate()) {
            $this->equipment_category->update([
                'code' => $validated['code'],
                'name' => $validated['name'],
                'description' => $validated['description'],
                'status' => $this->status,
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
    public function clickEditEquipment()
    {
        if ($this->editEquipmentType == false) {
            $this->editEquipmentType = true;
            $this->label = "Huỷ chỉnh sửa";
            $this->class = "btn btn-warning";
        } else {
            $this->editEquipmentType = false;
            $this->label = "Chỉnh sửa kiểu tài sản";
            $this->class = "btn btn-primary";
            $this->editTypeId = '';
            $this->editTypeName = '';
            $this->addNewStatus = false;
        }
    }
    public function addNew()
    {
        if ($this->addNewStatus == false) {
            $this->addNewStatus = true;
        } else {
            $this->addNewStatus = false;
        }
    }
    public function addNewType()
    {
        $this->validate([
            'newType' => 'required|unique:asset_type,name'
        ]);
        AssetType::create([
            'name' => $this->newType,
            'status' => 1,
            'created_by' => Auth::user()->id
        ]);
        $this->dispatch(
            'alert',
            type: 'success',
            title: 'Thêm mới thành công',
            position: 'center',
            timer: 1500,
            confirm: false
        );
        $this->reset('newType');
    }
    public function editType($id)
    {
        $this->editTypeId = $id;
        $this->editTypeName = AssetType::find($this->editTypeId)->name;
    }
    public function cancelEdit()
    {
        $this->editTypeId = '';
    }
    #[On('deleted')]
    public function deleteTypeConfirm($id)
    {
        $type = AssetType::find($id);
        if ($type) {
            $type->update([
                'status' => 0
            ]);
        }
    }
    public function deleteType($id)
    {
        $type = AssetType::find($id);
        $this->dispatch(
            'confirm',
            title: 'Bạn đã chắc chưa ?',
            text: 'Bạn có chắc xoá kiểu tài sản ' . $type->name,
            confirmText: 'Có, tôi đã chắc',
            cancelText: 'Không',
            userId: $type->id,
            method: 'deleted',
        );
    }
    public function updateType($id)
    {
        $type = AssetType::find($id);
        $this->validate([
            'editTypeName' => 'required|unique:asset_type,name,' . $type->name,
        ]);
        if ($type) {
            $type->update([
                'name' => $this->editTypeName,
            ]);
            $this->dispatch(
                'alert',
                type: 'success',
                title: 'Cập nhật thành công',
                position: 'center',
                timer: 1500,
                confirm: false
            );
            $this->editTypeId = '';
            $this->editTypeName = '';
        }
    }
    public function validationAttributes()
    {
        return [
            'name' => 'Tên loại thiết bị',
            'description' => 'Mô tả',
            'asset_type_id' => 'Kiểu tài sản',
            'code' => 'Mã tài sản',
            'newType' => 'Tên kiểu tài sản',
            'editTypeName' => 'Tên kiểu tài sản'
        ];
    }
    public function rules()
    {
        return [
            'name' => 'required|unique:asset_type,name,' . $this->equipment_category->id,
            'description' => 'nullable',
            'asset_type_id' => 'required',
            'code' => 'required|unique:asset_category,code,' . $this->equipment_category->id
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'unique' => ':attribute đã tồn tại.',
        ];
    }
}
