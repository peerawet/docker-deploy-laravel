<?php

namespace App\Livewire\Components\Form\users;

use Livewire\Component;

class FormPermission extends Component
{
    public $menus;
    public function render()
    {
        return view('livewire.components.form.users.formPermission');
    }
}
