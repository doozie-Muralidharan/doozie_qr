<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QR_details extends Model
{
    //use HasFactory;
    protected $table = 'qr_details';
    protected $primarykey = 'id';
    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
