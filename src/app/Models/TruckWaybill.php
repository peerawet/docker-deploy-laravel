<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TruckWaybill extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'consignor_shipper',
        'consignee',
        'truck_waybill_no',
        'notify_party',
        'mto_name_address',
        'invoice_no',
        'place_of_loading',
        'date_of_receipt',
        'place_of_discharge',
        'final_destination',
        'marks_and_no',
        'no_of_packages',
        'description_of_goods',
        'gross_net_weight',
        'measurements',
        'container_no',
        'seal_no',
        'freight_details',
        'freight_payable_at',
        'place_date_of_issue',
        'no_of_copies',
        'created_at',
        'edit_by',
        'edit_date',
        'truck_no',
    ];

    public function drafts()
    {
        return $this->hasMany(Draft::class, 'booking_no', 'invoice_no');
    }
}
