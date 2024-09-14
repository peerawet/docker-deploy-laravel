<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceInformation extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'invoice_information';

    /**
     * Indicates if the model's primary key is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'information',
        'invoice_no',
        'sell_id',
    ];

    // Define relationships if needed
    // For example:

    /**
     * Get the invoice associated with the information.
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_no', 'invoice_no');
    }

    /**
     * Get the sell associated with the information.
     */
    public function sell()
    {
        return $this->belongsTo(Sell::class, 'sell_id', 'id');
    }
}
