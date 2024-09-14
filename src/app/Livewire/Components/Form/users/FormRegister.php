<?php

namespace App\Livewire\Components\Form\users;

use Livewire\Component;

class FormRegister extends Component
{
    public $roles;
    public function render()
    {
        return view('livewire.components.form.users.formRegister');
    }
}
