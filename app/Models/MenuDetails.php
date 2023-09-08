<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

//use Illuminate\Database\Eloquent\SoftDeletes;

class MenuDetails extends Model
{
   // use SoftDeletes;
    //use HasFactory;
    protected $table = 'menu_details';
    protected $id = 'id';
    protected $guarded = [];
    //protected $fillable = ['menu_item_name', 'cost_in_inr', 'catgory_id', 'customer_id'];

    // public function cuisine()
    // {
    //     return $this->belongsTo(Cuisine::class);
    // }

    public static function getMenuDetails(){
        $result = DB::table('menu_details')->select('id', 'menu_item_name', 'cost_in_inr', 'catgory_tag')
            ->get()->toArray();

        return $result;
    }
}
