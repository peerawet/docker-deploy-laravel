<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterFileAgent extends Model
{
    use HasFactory;

    protected $table = "master_file_agent"; // Adjust the table name

    protected $fillable = [
        'name',
        'contact',
        'tel',
        'agent_id',
        'note',
        'edit_by',
        'edit_date',
    ];

    public $timestamps = false; // Disable timestamps
    public function drafts()
    {
        return $this->hasMany(Draft::class);
    }
}
