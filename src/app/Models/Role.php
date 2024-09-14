<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'roles';

    protected $fillable = [
        'name',
        'update_by',
        'create_by', // Add this line if not already present
    ];

    /**
     * The menus that belong to the role.
     */
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'roles_menus', 'role_id', 'menu_id');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
