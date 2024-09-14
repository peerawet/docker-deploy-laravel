<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'receipts';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'receipt_no';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'receipt_no',
        'receipt_date',
        'is_vat',
        'receipt_description_id',
        'bank',
        'branch',
        'bank_number',
        'transaction_date',
        'payment_method',
        'prepared_by',
        'edit_date',
        'edit_by',
        'invoice_no',
        // Add other attributes here as needed
    ];

    protected $casts = [
        'receipt_no' => 'string', // Ensure it's cast to string
        'invoice_no' => 'string',
    ];

    /**
     * Get the user who prepared the receipt.
     */
    public function preparedBy()
    {
        return $this->belongsTo(User::class, 'prepared_by', 'id');
    }

    /**
     * Get the user who edited the receipt.
     */
    public function editedBy()
    {
        return $this->belongsTo(User::class, 'edit_by', 'id');
    }

    /**
     * Define other relationships as needed.
     */

  
     public function bank()
     {
         return $this->belongsTo(MasterFileBank::class, 'bank_id', 'id');
     }

     public function invoice()
     {
         return $this->belongsTo(Invoice::class, 'invoice_no', 'invoice_no');
     }




}

