<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterFileReceiptDescription extends Model
{
    use HasFactory;

    protected $table = "master_file_receipt_description"; // Adjust the table name

    protected $fillable = [
        'description',
        'note',
        'edit_by',
        'edit_date',
    ];

    public $timestamps = false; // Disable timestamps
}
