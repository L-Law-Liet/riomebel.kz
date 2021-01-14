<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    protected $table = 'seo';
    public $timestamps = false;

    protected $fillable = [
        'url', 'title', 'description', 'keywords'
    ];
}
