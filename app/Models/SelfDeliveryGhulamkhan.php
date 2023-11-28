<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelfDeliveryGhulamkhan extends Model
{
    use HasFactory;
    protected $fillable = ['comission'];
    public function admin()
    {
        return $this->belongsTo(Admin::class,'name');
    }
    public function selforder()
    {
        return $this->belongsTo(SelfDeliveryKharlachi::class,'musalsal_num');
    }

    public function selfDeliveryGhulamkhan()
    {
        return $this->hasOne(SelfDeliveryGhulamkhan::class);
    }
}
