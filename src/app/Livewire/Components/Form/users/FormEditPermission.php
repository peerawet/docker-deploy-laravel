<?php

namespace App\Livewire\Components\Form\users;

use Livewire\Component;

class FormEditPermission extends Component
{
    public $role;
    public $menus;
    public function render()
    {
        return view('livewire.components.form.users.formEditPermission');
    }
}
