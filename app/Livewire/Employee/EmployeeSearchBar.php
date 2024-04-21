<?php

namespace App\Livewire\Employee;

use App\Models\Employee;
use Livewire\Attributes\On;
use Livewire\Component;

class EmployeeSearchBar extends Component
{

    public $result;
    public $query = '';
    public $label = 'Người tạo';

    #[On('searchReset')]
    public function mount()
    {
        $this->result = [];
    }
    public function customReset()
    {
        $this->result = [];
    }
    public function updatedQuery()
    {
        $this->result = Employee::where('name', 'like', '%' . $this->query . '%')->limit(5)->get();
    }
    public function render()
    {
        return view('livewire.employee.employee-search-bar');
    }
    public function fillData($data)
    {
        $this->query = $data;
        $this->result = [];
        $this->dispatch('fillData', $data);
    }
}
