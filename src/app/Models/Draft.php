<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Draft extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'draft_no',
        'booking_no',
        'customer_ref',
        'shipper_id',
        'agent_id',
        'container_type_id',
        'loading_date',
        'feeder_id',
        'voy_feeder',
        'return_date',
        'vessel_id',
        'voy_vessel',
        'ETD_date',
        'ETA_date',
        'closing_date',
        'closing_time',
        'depot_id',
        'gate_in_depot_id',
        'status',
        'draft_date',
        'sale_id',
        'remark',
        'prepared_by',
        'created_at',
        'edit_by',
        'edit_date',
        'pick_up_date',
        'first_container_return_date',
        'transhipment_port_id',
        'loading_port_id',
        'destination_port_id',
        'temp',
        'qty',
        'SI_time', // Add new columns
        'SI_date',
        'VGM_date',
        'VGM_time',
        'type',
        'loading_time',
        'loading_location_id', // Newly added columns
        'cross_border_date',
        'delivery_location_id',
        'incident_id',
    ];

    protected $casts = [
        'draft_no' => 'string', // Ensure it's cast to string
    ];

    public function truckWaybill()
    {
        return $this->belongsTo(TruckWaybill::class, 'booking_no', 'invoice_no');
    }
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'drafts';

    /**
     * Indicates if the model's primary key ID is not incrementing.
     *
     * @var bool
     */
    protected $primaryKey = 'draft_no';

    // public $incrementing = false;

    // /**
    //  * The primary key associated with the table.
    //  *
    //  * @var string
    //  */

    /**
     * Get the agent that owns the draft.
     */
    public function job()
    {
        return $this->hasOne(Job::class, 'draft_no', 'draft_no');
    }

    public function scopeWithoutJob($query)
    {
        return $query->whereDoesntHave('job');
    }

    public function agent()
    {
        return $this->belongsTo(MasterFileAgent::class, 'agent_id', 'id');
    }

    /**
     * Get the shipper of the draft.
     */
    public function shipper()
    {
        return $this->belongsTo(MasterFileShipper::class, 'shipper_id', 'id');
    }

    /**
     * Get the depot associated with the draft.
     */
    public function depot()
    {
        return $this->belongsTo(MasterFileDepot::class, 'depot_id', 'id');
    }

    /**
     * Get the container type associated with the draft.
     */
    public function containerType()
    {
        return $this->belongsTo(MasterFileContainerType::class, 'container_type_id', 'id');
    }

    /**
     * Get the gate in depot associated with the draft.
     */
    public function gateInDepot()
    {
        return $this->belongsTo(MasterFileGateInDepot::class, 'gate_in_depot_id', 'id');
    }

    /**
     * Get the sale associated with the draft.
     */
    public function sale()
    {
        return $this->belongsTo(MasterFileSale::class, 'sale_id', 'id');
    }

    public function preparedBy()
    {
        return $this->belongsTo(User::class, 'prepared_by', 'id');
    }

    public function editedBy()
    {
        return $this->belongsTo(User::class, 'edit_by', 'id');
    }

    public function vessel()
    {
        return $this->belongsTo(MasterFileVessel::class, 'vessel_id', 'id');
    }

    public function feeder()
    {
        return $this->belongsTo(MasterFileFeeder::class, 'feeder_id', 'id');
    }

    /**
     * Get the transhipment port associated with the draft.
     */
    public function transhipmentPort()
    {
        return $this->belongsTo(MasterFileTranshipmentPort::class, 'transhipment_port_id', 'id');
    }

    /**
     * Get the loading port associated with the draft.
     */
    public function loadingPort()
    {
        return $this->belongsTo(MasterFileLoadingPort::class, 'loading_port_id', 'id');
    }

    /**
     * Get the destination port associated with the draft.
     */
    public function destinationPort()
    {
        return $this->belongsTo(MasterFileDestinationPort::class, 'destination_port_id', 'id');
    }

    public function loadingLocation()
    {
        return $this->belongsTo(MasterFileLoadingLocation::class, 'loading_location_id', 'id');
    }

    public function deliveryLocation()
    {
        return $this->belongsTo(MasterFileDeliveryLocation::class, 'delivery_location_id', 'id');
    }

    public function incident()
    {
        return $this->belongsTo(Incident::class);
    }
}
