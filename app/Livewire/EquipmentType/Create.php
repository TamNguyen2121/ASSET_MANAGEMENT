<?php

namespace App\Livewire\EquipmentType;

use App\Models\EquipmentCategory;
use App\Models\EquipmentType;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;


#[Layout('layout.app.layout')]
#[Title('Thêm mới loại thiết bị')]
class Create extends Component
{
    #[Validate()]
    public $name;
    public $description;
    public $equipment_type_id;
    public $editEquipmentType = false;
    public $label = "Chỉnh sửa kiểu tài sản";
    public $class = "btn btn-primary";
    public $editTypeId = '';
    public $editTypeName;
    public $addNewStatus = false;
    public $newType;
    public $code;
    public function render()
    {
        return view('livewire.equipment-type.create', [
            'equipment_types' => EquipmentType::where('status', 1)->latest()->get()
        ]);
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
    public function createEquipmentCategory()
    {
        if ($validated = $this->validate()) {
            EquipmentCategory::create([
                'name' => $validated['name'],
                'code' => $validated['code'],
                'equipment_type_id' => $validated['equipment_type_id'],
                'description' => $validated['description'],
                'created_by' => Auth::user()->id,
                'status' => 1,
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
        }
    }
    public function editType($id)
    {
        $this->editTypeId = $id;
        $this->editTypeName = EquipmentType::find($this->editTypeId)->name;
    }
    public function cancelEdit()
    {
        $this->editTypeId = '';
    }
    #[On('deleted')]
    public function deleteTypeConfirm($id)
    {
        $type = EquipmentType::find($id);
        if ($type) {
            $type->update([
                'status' => 0
            ]);
        }
    }
    public function deleteType($id)
    {
        $type = EquipmentType::find($id);
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
        $type = EquipmentType::find($id);
        $this->validate([
            'editTypeName' => 'required|unique:equipment_types,name,' . $type->name,
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
            'newType' => 'required|unique:equipment_types,name'
        ]);
        EquipmentType::create([
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

    public function validationAttributes()
    {
        return [
            'name' => 'Tên loại thiết bị',
            'description' => 'Mô tả',
            'equipment_type_id' => 'Kiểu tài sản',
            'code' => 'Mã tài sản',
            'newType' => 'Tên kiểu tài sản',
            'editTypeName' => 'Tên kiểu tài sản'
        ];
    }
    public function rules()
    {
        return [
            'name' => 'required|unique:equipment_types,name',
            'description' => 'nullable',
            'equipment_type_id' => 'required',
            'code' => 'required|unique:equipment_categories,code'
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
