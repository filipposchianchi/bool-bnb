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

    public function users(){
        return $this -> belongsTo(User::class);
    }
    public function services(){
        return $this -> belongsToMany(Service::class);
    }
    public function promos(){
        return $this -> hasMany(Promo::class);
    }
}
