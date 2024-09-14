<?php

namespace App\Livewire\Components\Form\Invoice;

use Livewire\Component;
use App\Models\Draft;
use App\Models\Job;
use App\Models\MasterFileDescription;

class FormInvoice extends Component
{
    public $jobs;
    public $drafts;
    public $masterFileDescriptions;

    public function mount()
    {
        // Fetch jobs without associated invoices
        $this->jobs = Job::withoutInvoice()->get();
        // $this->jobs = Job::get();
        // Fetch all drafts
        $this->drafts = Draft::all();

        // Fetch all MasterFileDescription entries
        $this->masterFileDescriptions = MasterFileDescription::all();
    }

    public function render()
    {
        return view('livewire.components.form.invoice.form', [
            'drafts' => $this->drafts,
            'jobs' => $this->jobs,
            'masterFileDescriptions' => $this->masterFileDescriptions,
        ]);
    }
}
