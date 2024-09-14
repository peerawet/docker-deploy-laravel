<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'icon', 'route',
    ];

    /**
     * The roles that belong to the menu.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_menus', 'menu_id', 'role_id');
    }
}
