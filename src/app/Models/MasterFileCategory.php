<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterFileCategory extends Model
{
    use HasFactory;

    protected $table = "master_file_categories"; // Adjusted table name

    protected $fillable = [
        'category',
        'note',
        'edit_by',
        'edit_date',
    ];

    public $timestamps = false; // Disable timestamps
}
