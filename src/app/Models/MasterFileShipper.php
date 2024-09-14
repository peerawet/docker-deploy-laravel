<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterFileShipper extends Model
{
    use HasFactory;

    protected $table = "master_file_shipper";

    protected $fillable = [
        'name',
        'contact',
        'tel',
        'address',
        'note',
        'edit_by',
        'edit_date',
        'sale_id', // Adding sale_id to fillable attributes
    ];

    public $timestamps = false;

    public function drafts()
    {
        return $this->hasMany(Draft::class);
    }

    public function sale()
    {
        return $this->belongsTo(MasterFileSale::class, 'sale_id'); // Define the sale_id foreign key
    }
}
