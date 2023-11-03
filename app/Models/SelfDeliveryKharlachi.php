<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelfDeliveryKharlachi extends Model
{
    use HasFactory;
    public function admin()
    {
        return $this->belongsTo(Admin::class,'name');
    }
    public function selforder()
    {
        return $this->belongsTo(SelfDeliveryKharlachi::class,'musalsal_num');
    }
}
