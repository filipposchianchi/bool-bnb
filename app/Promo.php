<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $fillable = [
        'type',
    ];
    public function apartment(){
        return $this -> belongsTo(Apartment::class);
    }
}
