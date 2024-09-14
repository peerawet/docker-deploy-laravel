<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterFileGateInDepot extends Model
{
    use HasFactory;

    protected $table = "master_file_gate_in_depot"; // Adjust the table name

    protected $fillable = [
        'name',
        'contact',
        'tel',
        'note',
        'paper_less',
        'edit_by',
        'edit_date',
    ];

    public $timestamps = false; // Disable timestamps
}
