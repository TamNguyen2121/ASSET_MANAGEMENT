<?php

namespace App\Livewire\Asset;

use App\Models\Asset;
use App\Models\AssetCategory;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\AssetType;
use Livewire\Attributes\On;
use App\Models\Employee;

#[Layout('layout.app.layout')]
#[Title('Quản lý tài sản')]
class Index extends Component
{
    use WithPagination;

    public $page = 10;
    public $mySelect = [];
    public $selectAll = false;
    public $firstId = null;
    public $asset_type_id;
    public $name;
    public $code;
    public $startDate;
    public $endDate;
    public $employee_id = null;
    public $user_name;
    public $use_status;
    public $asset_type;
    public $asset_category = [];

    public function render()
    {
        $equipments = $this->searchEquipment();
        if (!$equipments->isEmpty()) {
            $this->firstId = $equipments[0]->id;
        } else {
            $this->firstId = null;
        }
        $this->asset_type = AssetType::where('status', 1)->latest()->get();
        return view('livewire.asset.index', [
            'equipments' => $equipments,
            'asset_type' => $this->asset_type,
        ]);
    }
    public function searchEquipment()
    {
        $query = Asset::query();
        if (!empty($this->name)) {
            $query->whereHas('equipmentType', function ($equipmentQuery) {
                $equipmentQuery->where('name', 'like', '%' . $this->name . '%');
            });
        }
        if (!empty($this->code)) {
            $query->where('code', 'like', '%' . $this->code . '%');
        }
        if (!empty($this->asset_type_id)) {
            $query->where('asset_type_id', $this->asset_type_id);
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
        if (!empty($this->employee_id)) {
            $query->where('created_by', $this->employee_id);
        }
        return $query->where('status', 1)->latest()->paginate($this->page);
        $this->gotoPage(1);
    }
    #[On('updateUser')]
    public function updateUser($id)
    {
        $this->employee_id = $id;
    }
    public function resetSearch()
    {
        $this->name = '';
        $this->code = '';
        $this->employee_id = null;
        $this->use_status = '';
        $this->asset_type_id = null;
        $this->mySelect = [];
        $this->selectAll = false;
        $this->dispatch('searchReset');
    }
    #[On('fillData')]
    public function fillUser($data)
    {
        $this->user_name = $data;
        $this->employee_id = Employee::where('name', 'like', '%' . $this->user_name . '%')->pluck('id');
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
        $query = Asset::where('id', '>=', $this->firstId)
            ->where('status', 1)
            ->orderBy('id', 'asc')
            ->limit($this->page);
        if (!empty($this->name)) {
            $query->where('name', 'like', '%' . $this->name . '%');
        }
        if (!empty($this->code)) {
            $query->where('code', 'like', '%' . $this->code . '%');
        }
        if (!empty($this->asset_type_id)) {
            $query->where('asset_type_id', $this->asset_type_id);
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
        if (!empty($this->employee_id)) {
            $query->where('created_by', $this->employee_id);
        }
        if ($this->selectAll == true) {
            $this->mySelect = $query->pluck('id');
        } else {
            $this->mySelect = [];
        }
    }
    public function deleteEquipment($id)
    {
        $equipment = Asset::find($id);
        $this->dispatch(
            'confirm',
            title: 'Bạn đã chắc chưa ?',
            text: 'Bạn có chắc xoá loại tài sản ' . $equipment->name,
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
        $equipment = Asset::find($id);
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
        Asset::whereIn('id', $id)->update(['status' => 0]);
        $this->resetMySelect();
    }
}
