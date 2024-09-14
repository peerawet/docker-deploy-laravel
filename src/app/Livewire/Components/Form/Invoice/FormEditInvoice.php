<?php

namespace App\Livewire\Components\Form\Invoice;

use Livewire\Component;
use App\Models\Draft;
use App\Models\Invoice;
use App\Models\MasterFileDescription;
use App\Models\Job;

class FormEditInvoice extends Component
{
    public $jobs;
    public $invoice;
    public $drafts;
    public $masterFileDescriptions;

    public function mount(Invoice $invoice)
    {
        $this->invoice = $invoice;
        
        // Fetch jobs without associated invoices
        // $this->jobs = Job::withoutInvoice()->get();
        $this->jobs = Job::get();
        // Fetch all drafts
        $this->drafts = Draft::all();
        
        // Fetch all MasterFileDescription entries
        $this->masterFileDescriptions = MasterFileDescription::all();
    }

    public function render()
    {
        return view('livewire.components.form.invoice.formEdit', [
            'invoice' => $this->invoice,
            'drafts' => $this->drafts,
            'jobs' => $this->jobs,
            'masterFileDescriptions' => $this->masterFileDescriptions,
        ]);
    }
}
