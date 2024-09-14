<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'menu_id', 'title', 'icon', 'route',
    ];

    /**
     * Get the menu that owns the submenu.
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
