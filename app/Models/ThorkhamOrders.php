<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThorkhamOrders extends Model
{
    use HasFactory;
    protected $fillable = ['malwala', 'musalsal_num', 'date', 'city', 'product', 'vehicle_num', 'quantity',
    'detail', 'weight', 'weight_acc_to_50kg', 'total_qty', 'narkh', 'labour', 'pounch', 'total'];

    public function admin()
    {
        return $this->belongsTo(Admin::class,'malwala');
    }
}
