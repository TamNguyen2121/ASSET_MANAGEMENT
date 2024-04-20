<?php

namespace App\Livewire\Allocation;

use App\Models\Equipment;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use App\Models\User;
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
    public $user_id;
    public $object;
    public function render()
    {
        return view('livewire.allocation.create');
    }
    public function mount($id)
    {
        $this->equipment = Equipment::find($id);
        $this->options = [
            0 => "Cá nhân",
            1 => "Tập thể"
        ];
    }
    public function createAllocation()
    {
        if ($validated = $this->validate()) {
            $user_id = $validated['user_id'][0];
            $allocation = new Allocation();
            $allocation->create([
                "equipment_id" => $this->equipment->id,
                "object" => $validated["object"],
                "reciver_id" => $user_id,
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
        $this->user_id = $id;
    }
    #[On('fillData')]
    public function fillUser($data)
    {
        $this->user_name = $data;
        $this->user_id = User::where('name', 'like', '%' . $this->user_name . '%')->pluck('id');
    }
    public function validationAttributes()
    {
        return [
            'user_id' => 'Người nhận',
            'object' => 'Đối tượng',
        ];
    }
    public function rules()
    {
        return [
            'user_id' => 'required',
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
