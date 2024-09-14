<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Job extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'jobs';

    /**
     * Indicates if the model's primary key ID is not incrementing.
     *
     * @var bool
     */
    // Ensure the 'job_no' is set to auto-increment
    public $incrementing = true;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'job_no';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_no',
        'draft_no',
        'cost_remark',
        'sell_remark',
        'prepared_by',
        'job_date',
        'edit_by',
        'edit_date',
        'cost_second_other_value',
        'cost_second_other_name',
        'cost_first_other_value',
        'cost_first_other_name',
        'cost_kbc_thb',
        'cost_kba_thb',
        'cost_transport',
        'cost_rate_value',
        'cost_vat_value',
        'sell_rate_value',
        'sell_vat_value',
        'cost_sub_total',
        'cost_total_vat',
        'cost_tax_1',
        'cost_tax_3',
        'cost_tax_amt',
        'cost_total_with_vat',
        'cost_total_without_vat',
        'cost_grand_total',
        'sell_sub_total',
        'sell_total_vat',
        'sell_tax_1',
        'sell_tax_3',
        'sell_tax_amt',
        'sell_total_with_vat',
        'sell_total_without_vat',
        'sell_grand_total',
        'spend',
        'profit'
    ];

    protected $casts = [
        'job_no' => 'string', // Ensure it's cast to string
    ];
    /**
     * Get the draft associated with the job.
     */
    public function draft()
    {
        return $this->hasOne(Draft::class, 'draft_no', 'draft_no');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'job_no', 'job_no');
    }

    // Scope to get jobs without invoices
    public function scopeWithoutInvoice(Builder $query)
    {
        return $query->whereDoesntHave('invoice');
    }

    /**
     * Get the user who prepared the job.
     */
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

    public function costs()
    {
        return $this->hasMany(Cost::class, 'job_no', 'job_no');
    }

    public function sells()
    {
        return $this->hasMany(Sell::class, 'job_no', 'job_no');
    }
}
