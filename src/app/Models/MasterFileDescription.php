<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterFileDescription extends Model
{
    use HasFactory;

    protected $table = "master_file_description"; // Adjust the table name

    protected $fillable = [
        'description',
        'invoice_description',
        'edit_by',
        'edit_date',
    ];

    public $timestamps = false; // Disable timestamps
}
