<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelfDeliveryExpenseGhulamkhan extends Model
{
    use HasFactory;
    protected $fillable = ['musalsal_num', 'comission', 'name', ];

    public function orders()
    {
        return $this->hasMany(KharlachiOrders::class);
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class,'name');
    }
}
