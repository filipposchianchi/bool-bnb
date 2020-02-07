<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $fillable = [
        'type',
    ];
    public function promos(){
        return $this -> belongsTo(Promo::class);
    }
}
