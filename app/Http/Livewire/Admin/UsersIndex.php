<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;
    public $search;
    protected $paginationTheme = "bootstrap";

    public function updatingsearch(){
                    $this->resetPage();
    }
    public function render()
    {

        $users = User::where('email', 'LIKE','%'.$this->search.'%')
            ->orwhere('dni', 'LIKE', '%'.$this->search .'%')
        ->paginate();
        return view('livewire.admin.users-index', \compact('users'));
    }
}
