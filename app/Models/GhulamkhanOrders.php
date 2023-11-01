<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GhulamkhanOrders extends Model
{
    use HasFactory;
    protected $fillable = ['malwala', 'musalsal_num', 'date', 'city', 'product', 'vehicle_num', 'quantity',
    'detail','kiraya','mutabik_kiraya', 'extra_kiraya', 'ponch', 'total', 'total_af' ];
    public function admin()
    {
        return $this->belongsTo(Admin::class,'malwala');
    }
}
