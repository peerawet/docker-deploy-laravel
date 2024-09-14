<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sells';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description_id',
        'value',
        'rate',
        'vat',
        'tax',
        'information',
        'job_no',
        'invoice_no'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the job associated with the sell.
     */
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_no', 'job_no');
    }

    public function description()
    {
        return $this->belongsTo(MasterFileDescription::class);
    }
}
