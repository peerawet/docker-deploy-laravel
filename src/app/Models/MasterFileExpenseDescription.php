<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterFileExpenseDescription extends Model
{
    use HasFactory;

    protected $table = "master_file_expense_description"; // Adjusted table name

    protected $fillable = [
        'description',
        'note',
        'edit_by',
        'edit_date' 
    ];

    // Optionally, if you want to enable timestamps (created_at and updated_at fields)
    public $timestamps = false;

    // If you want to customize the timestamp fields, use the following:
    // protected $createdAt = 'created_at'; // Customize created_at field name
    // protected $updatedAt = 'updated_at'; // Customize updated_at field name
}
