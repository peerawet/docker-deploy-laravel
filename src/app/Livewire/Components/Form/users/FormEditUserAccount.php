<?php

namespace App\Livewire\Components\Form\users;

use Livewire\Component;

class FormEditUserAccount extends Component
{
    public $user;

    public function mount($user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.components.form.users.formEditUserAccount');
    }
}
