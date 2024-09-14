<?php

namespace App\Livewire\Components\Assets;

use Livewire\Component;

class ButtonType extends Component
{

    public $title;
    public $icon;
    public $type;
    public $color;
    public $action;

    public function mount($title, $icon, $type, $color, $action)
    {
        $this->title = $title;
        $this->icon = $icon;
        $this->type = $type;
        $this->color = $color;
        $this->action = $action;
    }
    public function render()
    {
        return view('livewire.components.assets.button-type');
    }
}
