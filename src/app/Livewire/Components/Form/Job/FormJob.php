<?php

namespace App\Livewire\Components\Form\Job;

use Livewire\Component;

use App\Models\Draft;
use App\Models\MasterFileDescription;

class FormJob extends Component
{
    public $drafts;
    public $masterFileDescriptions;

    public function mount()
    {
        // Fetch drafts without associated jobs
        $this->drafts = Draft::where('status', 'Get')->withoutJob()->get();
        
        // Fetch all MasterFileDescription entries
        $this->masterFileDescriptions = MasterFileDescription::all();
    }

    public function render()
    {
        return view('livewire.components.form.job.form', [
            'drafts' => $this->drafts,
            'masterFileDescriptions' => $this->masterFileDescriptions,
        ]);
    }
}
