<?php

namespace App\Livewire\Allocation;

use App\Models\allocation as Allocation;
use App\Models\Equipment;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layout.app.layout')]
#[Title('Chi tiết cấp phát')]
class View extends Component
{
    public $allocation;
    public $equipment;
    public $object;
    public $user_name;
    public function mount($id)
    {
        $this->allocation = Allocation::find($id);
        if ($this->allocation) {
            $this->equipment = Equipment::find($this->allocation->equipment_id);
            $this->object = $this->allocation->object;
            $this->user_name = User::find($this->allocation->reciver_id)->name;
        }
    }
    public function render()
    {
        return view('livewire.allocation.view');
    }
    public function stopDispensing()
    {
        $this->dispatch(
            'confirm',
            title: 'Bạn đã chắc chưa ?',
            text: 'Bạn có chắc ngừng cấp phát tài sản ' . $this->allocation->getEquipment()->name,
            confirmText: 'Có, tôi đã chắc',
            cancelText: 'Không',
            userId: $this->allocation->id,
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
        $this->allocation->status = 0;
    }
}
