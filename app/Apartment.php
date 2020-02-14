<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = [
        'title',
        'countryCode',
        'streetNumber',
        'streetName',
        'municipality',
        'postalCode',
        'description',
        'image',
        'roomNum',
        'bedNum',
        'mQ',
        'wcNum',
        'view',
        'visible',
        'latitude',
        'longitude'
    ];

    public function user(){
        return $this -> belongsTo(User::class);
    }
    public function services(){
        return $this -> belongsToMany(Service::class);
    }
    public function promos(){
        return $this -> belongsToMany(Promo::class);
    }

    public function messages () {
        return $this -> hasMany(Message::class);
    }
}
