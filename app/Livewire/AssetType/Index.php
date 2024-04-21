<?php

namespace App\Livewire\AssetType;

use App\Models\AssetCategory;
use App\Models\AssetType;
use App\Models\Employee;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\WithPagination;


#[Layout('layout.app.layout')]
#[Title('Quản lý loại tài sản')]
class Index extends Component
{
    use WithPagination;

    public $page = 10;
    public $mySelect = [];
    public $selectAll = false;
    public $firstId = null;
    public $user_name;
    public $result = [];
    public $code;
    public $equipment_type;
    public $name;
    public $employee_id = null;

    public function render()
    {
        $asset_category = $this->searchEquipmentCategory();
        if (!$asset_category->isEmpty()) {
            $this->firstId = $asset_category[0]->id;
        } else {
            $this->firstId = null;
        }
        return view('livewire.asset-type.index', [
            'asset_category' => $asset_category,
            'asset_type' => AssetType::all(),
        ]);
    }
    public function updated()
    {
        $this->gotoPage(1);
    }
    public function searchEquipmentCategory()
    {
        $query = AssetCategory::query();
        if (!empty($this->name)) {
            $query->where('name', 'like', '%' . $this->name . '%');
        }
        if (!empty($this->equipment_type)) {
            $query->where('asset_type_id', $this->equipment_type);
        }
        if (!empty($this->code)) {
            $query->where('code', 'like', '%' . $this->code . '%');
        }
        if (!empty($this->employee_id)) {
            $query->where('created_by', $this->employee_id);
        }
        return $query->where('status', 1)->latest()->paginate($this->page);
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
        $this->equipment_type = '';
        $this->dispatch('searchReset');
    }
    #[On('fillData')]
    public function fillUser($data)
    {
        $this->user_name = $data;
        $this->employee_id = Employee::where('name', 'like', '%' . $this->user_name . '%')->pluck('id');
    }
    public function deleteEquipmentCategory($id)
    {
        $equipment_category = AssetCategory::find($id);
        $this->dispatch(
            'confirm',
            title: 'Bạn đã chắc chưa ?',
            text: 'Bạn có chắc xoá loại tài sản ' . $equipment_category->name,
            confirmText: 'Có, tôi đã chắc',
            cancelText: 'Không',
            userId: $equipment_category->id,
            method: 'deleted',
        );
        $this->resetMySelect();
    }
    #[On('deleted')]
    public function deleteConfirmed($id)
    {
        $equipment_category = AssetCategory::find($id);
        if ($equipment_category) {
            $equipment_category->update([
                'status' => 0,
            ]);
        }
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
        $query = AssetCategory::where('id', '>=', $this->firstId)
            ->where('status', 1)
            ->orderBy('id', 'asc')
            ->limit($this->page);
        if (!empty($this->name)) {
            $query->where('name', 'like', '%' . $this->name . '%');
        }
        if (!empty($this->equipment_type)) {
            $query->where('asset_type_id', $this->equipment_type);
        }
        if (!empty($this->code)) {
            $query->where('code', 'like', '%' . $this->code . '%');
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
    public function deleteAll()
    {
        if (count($this->mySelect) == 0) {
            $this->dispatch(
                'alert',
                type: 'warning',
                title: 'Không có loại tài sản để xoá',
                position: 'center',
                timer: 1500,
                confirm: false
            );
        } else {
            $this->dispatch(
                'confirm',
                title: 'Bạn đã chắc chưa ?',
                text: 'Bạn có chắc xoá ' . count($this->mySelect) . ' loại tài sản',
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
        AssetCategory::whereIn('id', $id)->update(['status' => 0]);
        $this->resetMySelect();
    }
}
