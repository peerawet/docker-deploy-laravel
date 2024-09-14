<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Invoice extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'invoices';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'invoice_no';

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
        'invoice_no',
        'invoice_date',
        
        'bl_no',
        'container_no',
        'due_date',
        'ref_no',
        'attn',
        'fax',
        'remark',
        'prepared_by',
        'created_at',
        'edit_date',
        'edit_by',
        'status',
        'job_no',
    ];

    protected $casts = [
        'invoice_no' => 'string', // Ensure it's cast to string
        'job_no' => 'string',
    ];

     // Define the relationship with the Receipt model
     public function receipt()
     {
         return $this->hasOne(Receipt::class, 'invoice_no', 'invoice_no');
     }
 
     // Scope to get invoices without receipts
     public function scopeWithoutReceipt(Builder $query)
     {
         return $query->whereDoesntHave('receipt');
     }
    /**
     * Get the job associated with the invoice.
     */
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_no', 'job_no');
    }

    public function preparedBy()
    {
        return $this->belongsTo(User::class, 'prepared_by', 'id');
    }

    /**
     * Get the user who edited the job.
     */
    public function editedBy()
    {
        return $this->belongsTo(User::class, 'edit_by', 'id');
    }

    public function informations()
    {
        return $this->hasMany(InvoiceInformation::class, 'invoice_no', 'invoice_no');
    }
}
