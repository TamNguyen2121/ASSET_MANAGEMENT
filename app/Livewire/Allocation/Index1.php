<?php

namespace App\Livewire\Allocation;

use App\Models\allocation as Allocation;
use App\Models\EquipmentType;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Models\User;

#[Layout('layout.app.layout')]
#[Title('Quản lý cấp phát')]
class Index1 extends Component
{
    use WithPagination;
    public $code;
    public $name;
    public $parent_id;
    public $user_name;
    public $user_id;
    public $use_status;
    public $startDate;
    public $endDate;

    public $page = 10;
    public function render()
    {
        $allocation = $this->searchEquipment();
        return view('livewire.allocation.index1', [
            'allocations' => $allocation,
            'equipment_types' => EquipmentType::where('status', 1)->latest()->get()
        ]);
    }
    public function searchEquipment()
    {
        $query = Allocation::query();
        if (!empty($this->parent_id)) {
            $query->whereHas('equipment', function ($equipmentQuery) {
                $equipmentQuery->where('equipment_type_id', $this->parent_id);
            });
        }
        if (!empty($this->name)) {
            $query->whereHas('equipment.equipmentType', function ($equipmentQuery) {
                $equipmentQuery->where('name', 'like', '%' . $this->name . '%');
            });
        }
        if (!empty($this->code)) {
            $query->whereHas('equipment', function ($equipmentQuery) {
                $equipmentQuery->where('code', $this->code);
            });
        }
        if ($this->use_status != null) {
            $query->whereHas('equipment', function ($equipmentQuery) {
                $equipmentQuery->where('use_status', $this->use_status);
            });
        }
        if (!empty($this->user_id)) {
            $query->where('reciver_id', $this->user_id);
        }
        if (!empty($this->startDate)) {
            $query->where('created_at', '>=', $this->startDate);
        }
        if (!empty($this->endDate)) {
            $query->where('created_at', '<=', $this->endDate);
        }
        return $query->where('status', 1)->paginate($this->page);
        $this->gotoPage(1);
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
    public function resetSearch()
    {
        $this->parent_id = '';
        $this->name = '';
        $this->code = '';
        $this->startDate = '';
        $this->endDate = '';
        $this->user_id = null;
        $this->use_status = '';
        $this->dispatch('searchReset');
    }
    public function stopDispensing($id)
    {
        $allocation = Allocation::find($id);
        $this->dispatch(
            'confirm',
            title: 'Bạn đã chắc chưa ?',
            text: 'Bạn có chắc thu hồi tài sản ' . $allocation->getEquipment()->name,
            confirmText: 'Có, tôi đã chắc',
            cancelText: 'Không',
            userId: $allocation->id,
            method: 'deleted',
        );
    }
    #[On('deleted')]
    public function dispensingConfirmed($id)
    {
        $allocation = Allocation::find($id);
        if ($allocation) {
            $allocation->update([
                'status' => 0,
            ]);
        }
    }
}
