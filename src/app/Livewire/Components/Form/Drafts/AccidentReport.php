<?php

namespace App\Livewire\Components\Form\Drafts;

use Livewire\Component;
use App\Models\Draft;

class AccidentReport extends Component
{
    public $selectedDraft;
    public $drafts;

    public function mount($selectedDraft, $drafts)
    {
        $this->selectedDraft = $selectedDraft;
        $this->drafts = $drafts;
    }

    public function render()
    {
        // Render your Livewire component with the passed $selectedDraft and $drafts data
        return view('livewire.components.form.drafts.accident-report');

        
    }

    
}
