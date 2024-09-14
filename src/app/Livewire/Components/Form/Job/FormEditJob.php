<?php

namespace App\Livewire\Components\Form\Job;

use Livewire\Component;
use App\Models\Draft;
use App\Models\Job;
use App\Models\MasterFileDescription;

class FormEditJob extends Component
{
    public $job;
    public $drafts;
    public $masterFileDescriptions;

    public function mount($job)
    {
        $this->job = $job;
        // Fetch drafts without associated jobs
        $this->drafts = Draft::where('status', 'Get')->withoutJob()->get();
        
        // Fetch all MasterFileDescription entries
        $this->masterFileDescriptions = MasterFileDescription::all();
    }

    public function render()
    {
        return view('livewire.components.form.job.formEdit', [
            'job' => $this->job,
            'drafts' => $this->drafts,
            'masterFileDescriptions' => $this->masterFileDescriptions,
        ]);
    }
}
