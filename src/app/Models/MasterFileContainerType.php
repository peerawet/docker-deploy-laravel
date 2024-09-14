<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterFileContainerType extends Model
{
    use HasFactory;

    protected $table = "master_file_container_type"; // Adjust the table name

    protected $fillable = [
        'qty',
        'size',
        'temp',
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
