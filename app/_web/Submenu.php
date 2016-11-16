<?php

namespace bsm\_web;

use Illuminate\Database\Eloquent\Model;

use bsm\_web\Status;
use bsm\_web\Menu;

class Submenu extends Model
{
    protected $table = 'submenu';
    public $timestamps = false;
    protected $fillable = ['title', 'icon', 'url'];

    //Status - aturan_submenu - Submenu
    public function status()
    {
        return $this->belongsToMany(Status::class, 'aturan_submenu', 'submenu_id', 'status_id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
