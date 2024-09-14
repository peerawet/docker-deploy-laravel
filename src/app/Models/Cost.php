<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    // Disable timestamps
    public $timestamps = false;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'costs';

    /**
     * Indicates if the model's primary key ID is not incrementing.
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
        'description_id',
        'value',
        'rate',
        'vat',
        'tax',
        'job_no',
        
    ];

    /**
     * Get the job associated with the cost.
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
