<?php

namespace App\Livewire\Components\Table\users;

use Livewire\Component;
use App\Models\User; // Assuming your User model is located in the App\Models namespace
use Illuminate\Support\Facades\DB;

class TableUsersList extends Component
{
    public $users;

    public function mount()
    {
        // Retrieve data from the users table along with role information
        $this->users = User::select('users.*', 'roles.name as role_name')
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->get();
    }

    public function render()
    {
        // Pass the users data to the view
        return view('livewire.components.table.users.table-users', [
            'users' => $this->users,
        ]);
    }
}
