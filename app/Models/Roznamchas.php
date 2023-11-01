<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roznamchas extends Model
{
    use HasFactory;
    protected $fillable = ['country','serial_num','date_pk','date_af','khata_banam','detail','state','amount_pk',
    'amount_af','bilty','afghani'] ;

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'khata_banam'); 
    }
}
