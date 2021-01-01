<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Address extends Model
{
    protected $fillable = [
        'name',
        'city_id'
    ];
    public $timestamps = false;
}
