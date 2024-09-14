<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content', 'date', 'img_1', 'img_1_x', 'img_1_y', // Include img_1_x and img_1_y
        'img_2', 'img_2_x', 'img_2_y', // Include img_2_x and img_2_y
        'img_3', 'img_3_x', 'img_3_y', // Include img_3_x and img_3_y
        'bottom', 'edit_by', 'edit_date'
    ];

    /**
     * Get the drafts for the incident.
     */
    public function drafts()
    {
        return $this->hasMany(Draft::class);
    }
}
