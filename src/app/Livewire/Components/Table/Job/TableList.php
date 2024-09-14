<?php

namespace App\Livewire\Components\Table\Job;

use Livewire\Component;
use App\Models\Job;
use Livewire\WithPagination;

class TableList extends Component
{

    use WithPagination;
    public function render()
    {
        $jobs = Job::paginate(5);
        return view('livewire.components.table.Job.table-job', [
            'jobs' => $jobs,
        ]);
    }
}
