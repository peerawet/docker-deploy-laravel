<?php

namespace App\Livewire\Components\Form\Receipt;

use Livewire\Component;
use App\Models\Draft;
use App\Models\Job;
use App\Models\MasterFileReceiptDescription;
use App\Models\Invoice;
use App\Models\MasterFileBank;

class FormReceipt extends Component
{
    public $jobs;
    public $drafts;
    public $masterFileReceiptDescriptions;
    public $invoices;
    public $masterFileBanks;

    public function mount()
    {
        $this->jobs = Job::all();
        $this->drafts = Draft::all();
        $this->masterFileReceiptDescriptions = MasterFileReceiptDescription::all();
        $this->masterFileBanks = MasterFileBank::all();
        
        // Fetch invoices without associated receipts
        $this->invoices = Invoice::where('status', 'Get')->withoutReceipt()->get();
    }

    public function render()
    {
        return view('livewire.components.form.receipt.form', [
            'drafts' => $this->drafts,
            'jobs' => $this->jobs,
            'invoices' => $this->invoices,
            'masterFileReceiptDescriptions' => $this->masterFileReceiptDescriptions,
            'masterFileBanks' => $this->masterFileBanks,
        ]);
    }
}
