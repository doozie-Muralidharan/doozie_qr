<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuisine extends Model
{
    //use HasFactory;
    protected $table = 'cuisines';
    protected $primarykey = 'id';
    protected $guarded = [];

    public function menu_details()
    {
        return $this->hasMany(MenuDetails::class);
    }
}
