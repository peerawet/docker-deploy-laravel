<?php

namespace App\Livewire\Components\Form\Receipt;

use Livewire\Component;
use App\Models\Draft;
use App\Models\Job;
use App\Models\MasterFileReceiptDescription;
use App\Models\Invoice;
use App\Models\MasterFileBank;

class FormEditReceipt extends Component
{
    public $jobs;
    public $drafts;
    public $masterFileReceiptDescriptions;
    public $invoices;
    public $masterFileBanks;
    public $receipt;

    public function mount($receipt)
    {
        $this->jobs = Job::all();
        $this->drafts = Draft::all();
        $this->masterFileReceiptDescriptions = MasterFileReceiptDescription::all();
        $this->masterFileBanks = MasterFileBank::all();
        
        // Fetch invoices with status 'Get' and without associated receipts
        // $this->invoices = Invoice::where('status', 'Get')->withoutReceipt()->get();
        $this->invoices = Invoice::where('status', 'Get')->get();

        $this->receipt = $receipt;
    }

    public function render()
    {
        return view('livewire.components.form.receipt.formEdit', [
            'drafts' => $this->drafts,
            'jobs' => $this->jobs,
            'invoices' => $this->invoices,
            'masterFileReceiptDescriptions' => $this->masterFileReceiptDescriptions,
            'masterFileBanks' => $this->masterFileBanks,
            'receipt' => $this->receipt,
        ]);
    }
}
