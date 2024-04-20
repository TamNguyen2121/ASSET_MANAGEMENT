<?php

namespace App\Livewire\Allocation;

use App\Models\allocation as Allocation;
use App\Models\Equipment;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Livewire\Attributes\On;


#[Layout('layout.app.layout')]
#[Title('Chi tiết lịch sử cấp phát')]
class ViewHistory extends Component
{
    use WithPagination;
    public $equipment;
    public $page = 10;
    public function mount($id)
    {
        $this->equipment = Equipment::find($id);
    }
    public function render()
    {
        return view('livewire.allocation.view-history', [
            'allocations' => Allocation::where('equipment_id', $this->equipment->id)->paginate($this->page)
        ]);
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
