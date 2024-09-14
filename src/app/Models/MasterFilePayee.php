<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterFilePayee extends Model
{
    use HasFactory;

    protected $table = "master_file_payee"; // Adjusted table name

    protected $fillable = [
        'payee',
        'note',
        'edit_by',
        'edit_date',
    ];

    public $timestamps = false; // Disable timestamps
}
