<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterFileVessel extends Model
{
    use HasFactory;

    protected $table = "master_file_vessel"; // Adjust the table name

    protected $fillable = [
        'name',
        'note',
        'edit_by',
        'edit_date',
    ];

    public $timestamps = false; // Disable timestamps
}
