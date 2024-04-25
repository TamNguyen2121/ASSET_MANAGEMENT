<?php

namespace App\Livewire\Admin;

use App\Models\allocation as Allocation;
use App\Models\Asset;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layout.app.layout')]
#[Title('Trang chủ')]
class Index extends Component
{
    public $countEquipment;
    public $countAllocation;
    public $countBrokenEquipment;
    public $countDispensing;
    public $allocation;
    public function mount()
    {
        $this->countEquipment = Asset::where('status', 1)->count();
        $this->countAllocation = Allocation::where('allocate_status', 1)->count();
        $this->countDispensing = Allocation::where('allocate_status', 0)->count();
        $this->countBrokenEquipment = Asset::where('status', 1)->where('use_status', 0)->count();
    }
    public function render()
    {
        return view('livewire.admin.index',[
            'equipments' => Asset::where('status', 1)->get(),
        ]);
    }
}
