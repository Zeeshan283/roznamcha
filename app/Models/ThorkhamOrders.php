<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThorkhamOrders extends Model
{
    use HasFactory;
    protected $fillable = ['date', 'musalsal_num', 'date', 'name1', 'name2', 'vehicle_num', 'port',
    'p_of_d','n_plate_usd','product', 'quantity', 'weight', ];

    public function admin()
    {
        return $this->belongsTo(Admin::class,'name1');
    }
    public function admin1()
    {
        return $this->belongsTo(Admin::class,'name2');
    }

    public function self()
    {
        return $this->hasMany(SelfDeliveryThorkhams::class, 'musalsal_num', 'id');
    }

    public function expense()
    {
        return $this->hasMany(SelfDeliveryExpenseThorkhams::class, 'musalsal_num', 'id');
    }
}
