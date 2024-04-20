<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class UserSearchBar extends Component
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
        $this->result = User::where('name', 'like', '%' . $this->query . '%')->limit(5)->get();
    }
    public function render()
    {
        return view('livewire.user.user-search-bar');
    }
    public function fillData($data)
    {
        $this->query = $data;
        $this->result = [];
        $this->dispatch('fillData', $data);
    }
}
