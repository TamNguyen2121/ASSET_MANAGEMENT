<?php

namespace App\Livewire\Equipment;

use App\Models\Equipment;
use App\Models\EquipmentCategory;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\EquipmentType;
use Livewire\Attributes\On;
use App\Models\User;

#[Layout('layout.app.layout')]
#[Title('Quản lý thiết bị')]
class Index extends Component
{
    use WithPagination;

    public $page = 10;
    public $mySelect = [];
    public $selectAll = false;
    public $firstId = null;
    public $equipment_type_id;
    public $name;
    public $code;
    public $startDate;
    public $endDate;
    public $user_id = null;
    public $user_name;
    public $use_status;
    public $equipment_types;
    public $equipment_categories = [];

    public function render()
    {
        $equipments = $this->searchEquipment();
        if (!$equipments->isEmpty()) {
            $this->firstId = $equipments[0]->id;
        } else {
            $this->firstId = null;
        }
        $this->equipment_types = EquipmentType::where('status', 1)->latest()->get();
        return view('livewire.equipment.index', [
            'equipments' => $equipments,
            'equipment_types' => $this->equipment_types,
        ]);
    }
    public function searchEquipment()
    {
        $query = Equipment::query();
        if (!empty($this->name)) {
            $query->whereHas('equipmentType', function ($equipmentQuery) {
                $equipmentQuery->where('name', 'like', '%' . $this->name . '%');
            });
        }
        if (!empty($this->code)) {
            $query->where('code', 'like', '%' . $this->code . '%');
        }
        if (!empty($this->equipment_type_id)) {
            $query->where('equipment_type_id', $this->equipment_type_id);
        }
        if (!empty($this->startDate)) {
            $query->where('created_at', '>=', $this->startDate);
        }
        if (!empty($this->endDate)) {
            $query->where('created_at', '<=', $this->endDate);
        }
        if ($this->use_status != null) {
            $query->where('use_status', $this->use_status);
        }
        if (!empty($this->user_id)) {
            $query->where('created_by', $this->user_id);
        }
        return $query->where('status', 1)->latest()->paginate($this->page);
        $this->gotoPage(1);
    }
    #[On('updateUser')]
    public function updateUser($id)
    {
        $this->user_id = $id;
    }
    public function resetSearch()
    {
        $this->name = '';
        $this->code = '';
        $this->user_id = null;
        $this->use_status = '';
        $this->equipment_type_id = null;
        $this->mySelect = [];
        $this->selectAll = false;
        $this->dispatch('searchReset');
    }
    #[On('fillData')]
    public function fillUser($data)
    {
        $this->user_name = $data;
        $this->user_id = User::where('name', 'like', '%' . $this->user_name . '%')->pluck('id');
    }
    #[On('resetMySelect')]
    public function resetMySelect()
    {
        $this->mySelect = [];
        $this->selectAll = false;
    }
    public function updateMySelect()
    {
        if (count($this->mySelect) == $this->page) {
            $this->selectAll = true;
        } else {
            $this->selectAll = false;
        }
    }
    public function updateSelectAll()
    {
        $query = Equipment::where('id', '>=', $this->firstId)
            ->where('status', 1)
            ->orderBy('id', 'asc')
            ->limit($this->page);
        if (!empty($this->name)) {
            $query->where('name', 'like', '%' . $this->name . '%');
        }
        if (!empty($this->code)) {
            $query->where('code', 'like', '%' . $this->code . '%');
        }
        if (!empty($this->equipment_type_id)) {
            $query->where('equipment_type_id', $this->equipment_type_id);
        }
        if ($this->use_status != null) {
            $query->where('use_status', $this->use_status);
        }
        if (!empty($this->startDate)) {
            $query->where('created_at', '>=', $this->startDate);
        }
        if (!empty($this->endDate)) {
            $query->where('created_at', '<=', $this->endDate);
        }
        if (!empty($this->user_id)) {
            $query->where('created_by', $this->user_id);
        }
        if ($this->selectAll == true) {
            $this->mySelect = $query->pluck('id');
        } else {
            $this->mySelect = [];
        }
    }
    public function deleteEquipment($id)
    {
        $equipment = Equipment::find($id);
        $this->dispatch(
            'confirm',
            title: 'Bạn đã chắc chưa ?',
            text: 'Bạn có chắc xoá loại thiết bị ' . $equipment->name,
            confirmText: 'Có, tôi đã chắc',
            cancelText: 'Không',
            userId: $equipment->id,
            method: 'deleted',
        );
        $this->resetMySelect();
    }
    #[On('deleted')]
    public function deleteConfirmed($id)
    {
        $equipment = Equipment::find($id);
        if ($equipment) {
            $equipment->update([
                'status' => 0
            ]);
        }
    }
    public function deleteAll()
    {
        if (count($this->mySelect) == 0) {
            $this->dispatch(
                'alert',
                type: 'warning',
                title: 'Không có tài sản để xoá',
                position: 'center',
                timer: 1500,
                confirm: false
            );
        } else {
            $this->dispatch(
                'confirm',
                title: 'Bạn đã chắc chưa ?',
                text: 'Bạn có chắc xoá ' . count($this->mySelect) . ' tài sản',
                confirmText: 'Có, tôi đã chắc',
                cancelText: 'Không',
                userId: $this->mySelect,
                method: 'deletedAll',
            );
        }
    }
    #[On('deletedAll')]
    public function deletedAll($id)
    {
        Equipment::whereIn('id', $id)->update(['status' => 0]);
        $this->resetMySelect();
    }
}
