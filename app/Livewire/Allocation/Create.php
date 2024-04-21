<?php

namespace App\Livewire\Allocation;

use App\Models\Asset;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use App\Models\Employee;
use Livewire\Attributes\On;
use App\Models\allocation as Allocation;
use Illuminate\Support\Facades\Auth;

#[Layout('layout.app.layout')]
#[Title('Quản lý cấp phát')]

class Create extends Component
{
    #[Validate()]
    public $equipment;
    public $user_name;
    public $options;
    public $employee_id;
    public $object;
    public function render()
    {
        return view('livewire.allocation.create');
    }
    public function mount($id)
    {
        $this->equipment = Asset::find($id);
        $this->options = [
            0 => "Nhân viên",
            1 => "Phòng ban"
        ];
    }
    public function createAllocation()
    {
        if ($validated = $this->validate()) {
            $employee_id = $validated['employee_id'][0];
            $allocation = new Allocation();
            $allocation->create([
                "asset_id" => $this->equipment->id,
                "object" => $validated["object"],
                "reciver_id" => $employee_id,
                "created_by" => Auth::user()->id,
            ]);
            $this->dispatch(
                'alert',
                type: 'success',
                title: 'Cấp phát thành công',
                position: 'center',
                timer: 1500,
                confirm: false
            );
            return $this->redirectRoute('admin.allocation.list');
        }
    }
    #[On('updateUser')]
    public function updateUser($id)
    {
        $this->employee_id = $id;
    }
    #[On('fillData')]
    public function fillUser($data)
    {
        $this->user_name = $data;
        $this->employee_id = Employee::where('name', 'like', '%' . $this->user_name . '%')->pluck('id');
    }
    public function validationAttributes()
    {
        return [
            'employee_id' => 'Người nhận',
            'object' => 'Đối tượng',
        ];
    }
    public function rules()
    {
        return [
            'employee_id' => 'required',
            'object' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
        ];
    }
}
