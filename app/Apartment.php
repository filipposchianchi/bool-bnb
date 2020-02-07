<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = [
        'title',
        'address',
        'description',
        'img',
        'roomNum',
        'bedNum',
        'mQ',
        'wcNum',
        'view'
    ];

    public function user(){
        return $this -> belongsTo(User::class);
    }
    public function service(){
        return $this -> hasOne(Service::class);
    }
    public function promos(){
        return $this -> hasMany(Promo::class);
    }
}
