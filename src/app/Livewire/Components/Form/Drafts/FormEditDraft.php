<?php

namespace App\Livewire\Components\Form\Drafts;

use Livewire\Component;
use App\Models\MasterFileDepot;
use App\Models\MasterFileAgent;
use App\Models\MasterFileShipper;
use App\Models\MasterFileGateInDepot;
use App\Models\MasterFileContainerType;
use App\Models\MasterFileSale;
use App\Models\MasterFileFeeder;
use App\Models\MasterFileVessel;
use App\Models\MasterFileDestinationPort;
use App\Models\MasterFileLoadingPort;
use App\Models\MasterFileTranshipmentPort;
use App\Models\MasterFileLoadingLocation;
use App\Models\MasterFileDeliveryLocation;
use App\Models\TruckWaybill; // Add TruckWaybill model



class FormEditDraft extends Component
{
    public $all_depot;
    public $all_agents;
    public $all_shippers;
    public $all_gate_in_depots;
    public $all_container_types;
    public $all_sales;
    public $all_feeders;
    public $all_vessels;
    public $all_destination_ports;
    public $all_loading_ports;
    public $all_transhipment_ports;
    public $all_loading_locations;
    public $all_delivery_locations;

    public $draft;
    public $all_truck_waybills; // Add property for truck waybills

    public function mount()
    {
        // Fetch data from the database using the models
        $this->all_depot = MasterFileDepot::all();
        $this->all_agents = MasterFileAgent::all();
        $this->all_shippers = MasterFileShipper::all();
        $this->all_gate_in_depots = MasterFileGateInDepot::all();
        $this->all_container_types = MasterFileContainerType::all();
        $this->all_sales = MasterFileSale::all();
        $this->all_feeders = MasterFileFeeder::all();
        $this->all_vessels = MasterFileVessel::all();
        $this->all_destination_ports = MasterFileDestinationPort::all();
        $this->all_loading_ports = MasterFileLoadingPort::all();
        $this->all_transhipment_ports = MasterFileTranshipmentPort::all();
        $this->all_loading_locations = MasterFileLoadingLocation::all();
        $this->all_delivery_locations = MasterFileDeliveryLocation::all();

        $this->all_truck_waybills = TruckWaybill::all(); // Fetch all truck waybills
    }

    public function render()
    {
        // Pass all data to the view
        return view('livewire.components.form.drafts.formEditDraft', [
            'all_depot' => $this->all_depot,
            'all_agents' => $this->all_agents,
            'all_shippers' => $this->all_shippers,
            'all_gate_in_depots' => $this->all_gate_in_depots,
            'all_container_types' => $this->all_container_types,
            'all_sales' => $this->all_sales,
            'all_feeders' => $this->all_feeders,
            'all_vessels' => $this->all_vessels,
            'all_destination_ports' => $this->all_destination_ports,
            'all_loading_ports' => $this->all_loading_ports,
            'all_transhipment_ports' => $this->all_transhipment_ports,
            'all_loading_locations' => $this->all_loading_locations,
            'all_delivery_locations' => $this->all_delivery_locations,
            'all_truck_waybills' => $this->all_truck_waybills, // Pass all truck waybills to the view
        ]);
    }
}
