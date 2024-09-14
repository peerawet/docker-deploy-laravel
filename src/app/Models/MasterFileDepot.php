<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterFileDepot extends Model
{
    use HasFactory;

    protected $table = "master_file_depot"; // Adjust the table name

    protected $fillable = [
        'name',
        'contact',
        'tel',
        'note',
        'edit_by',
        'edit_date',
    ];

    public $timestamps = false; // Disable timestamps
}
