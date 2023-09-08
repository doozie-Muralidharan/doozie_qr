<?php

namespace App\Models;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    //use HasFactory;
    use SoftDeletes;
    protected $table = 'customers';
    protected $primarykey = 'id';
    protected $with = ['currency'];
    protected $softDelete = true;
    //protected $guarded = [];

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
