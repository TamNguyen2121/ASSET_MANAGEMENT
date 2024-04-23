<?php

namespace App\Livewire\Allocation;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\AssetType;
use App\Models\Asset;
use App\Models\allocation as Allocation;


#[Layout('layout.app.layout')]
#[Title('Quản lý cấp phát')]
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
    public $parent_id;
    public $use_status;
    public function render()
    {
        $equipments = $this->searchEquipment();
        return view('livewire.allocation.index', [
            'equipments' => $equipments,
            'asset_type' => AssetType::where('status', 1)->latest()->get()
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
        if ($this->use_status !== null) {
            $query->where('use_status', $this->use_status);
        } else {
            $query->whereIn('use_status', [0, 1]);
        }
        if (!empty($this->parent_id)) {
            $query->where('asset_type_id', $this->parent_id);
        }
        $query->whereIn('status', [1, 2]);
        $query->whereNotIn('id', function ($allocationQuery) {
            $allocationQuery->select('asset_id')
                ->from('allocation');
        });
        $query->orWhereHas('allocations', function ($allocationQuery) {
            $allocationQuery->where('status', 0);
        });

        return $query->paginate($this->page);
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
