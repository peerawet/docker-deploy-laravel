<?php

namespace App\Livewire\Components\Table\users;

use Livewire\Component;

class TablePermissionList extends Component
{
    public $roles; // Define a public property to store roles data

    public function render()
    {
        // Pass roles data to the view
        return view('livewire.components.table.users.table-permission', ['roles' => $this->roles]);
    }
}
