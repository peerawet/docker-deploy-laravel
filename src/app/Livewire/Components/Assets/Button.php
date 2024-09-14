<?php

namespace App\Livewire\Components\Assets;

use Livewire\Component;

class Button extends Component
{
    public $title;
    public $icon;
    public $route;
    public $color;

    public function mount($title, $icon, $route, $color, $action)
    {
        $this->title = $title;
        $this->icon = $icon;
        $this->route = $route;
        $this->color = $color;
    }
    public function render()
    {
        return view('livewire.components.assets.button');
    }
}
