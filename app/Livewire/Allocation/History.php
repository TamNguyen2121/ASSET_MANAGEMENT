<?php

namespace App\Livewire\Allocation;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Equipment;
use App\Models\EquipmentType;

#[Layout('layout.app.layout')]
#[Title('Quản lý cấp phát')]
class History extends Component
{
    use WithPagination;
    public $page = 10;
    public $mySelect = [];
    public $selectAll = false;
    public $firstId = null;

    public $equipment_type_id;
    public $name;
    public $code;
    public $parent_id;
    public $use_status;
    public function render()
    {
        $equipments = $this->searchEquipment();
        return view('livewire.allocation.history',[
            'equipments' => $equipments,
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
        if ($this->use_status != null) {
            $query->where('use_status', $this->use_status);
        }
        if (!empty($this->parent_id)) {
            $query->where('equipment_type_id', $this->parent_id);
        }
        return $query->where('status', 1)->whereIn('use_status', [0, 1])->paginate($this->page);
        $this->gotoPage(1);
    }
    public function resetSearch()
    {
        $this->parent_id = '';
        $this->name = '';
        $this->code = '';
        $this->use_status = '';
        $this->dispatch('searchReset');
    }
}
