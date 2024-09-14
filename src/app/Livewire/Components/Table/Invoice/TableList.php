<?php

namespace App\Livewire\Components\Table\Invoice;

use App\Livewire\Traits\DeleteAlert;
use Livewire\Component;

class TableList extends Component
{
    use DeleteAlert;
    protected $listeners = ['acceptDelete'];

    public function render()
    {
        return view('livewire.components.table.Invoice.table-invoice');
    }




}
