<?php

namespace App\Livewire\Components\Table\MasterFiles;

use Livewire\Component;
use App\Models\MasterFileDepot;
use App\Models\MasterFileAgent;
use App\Models\MasterFileShipper;
use App\Models\MasterFileGateInDepot;
use App\Models\MasterFileContainerType;
use App\Models\MasterFileSale;
use App\Models\MasterFileVessel;
use App\Models\MasterFileFeeder; // Add this import statement
use Livewire\WithPagination;

// class TableList extends Component
// {
//     use WithPagination;

//     public $allDepot;
//     public $allGateInDepot;
//     public $allAgents;
//     public $allShippers;
//     public $allContainerTypes;
//     public $allSales;
//     public $allVessels;
//     public $allFeeders; // Add this property

//     public function mount()
//     {
//         // Fetch data for Depot, Agents, Shippers, ContainerTypes, Sales, Vessels, and Feeders from the database using the models
//         $this->allDepot = MasterFileDepot::all();
//         $this->allGateInDepot = MasterFileGateInDepot::all();
//         $this->allAgents = MasterFileAgent::all();
//         $this->allShippers = MasterFileShipper::all();
//         $this->allContainerTypes = MasterFileContainerType::all();
//         $this->allSales = MasterFileSale::all();
//         $this->allVessels = MasterFileVessel::all();
//         $this->allFeeders = MasterFileFeeder::all(); // Fetch all feeders
//     }

//     public function render()
//     {
//         // Pass all data to the view, including vessels and feeders
//         return view('livewire.components.table.MasterFiles.table-master-files', [
//             'allDepot' => $this->allDepot,
//             'allGateInDepot' => $this->allGateInDepot,
//             'allAgents' => $this->allAgents,
//             'allShippers' => $this->allShippers,
//             'allContainerTypes' => $this->allContainerTypes,
//             'allSales' => $this->allSales,
//             'allVessels' => $this->allVessels,
//             'allFeeders' => $this->allFeeders // Pass all feeders to the view
//         ]);
//     }
// }
