<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Websites extends Model
{
    protected $fillable = [
        'name', 'url'
    ];
}
