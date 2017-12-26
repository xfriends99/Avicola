<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends Model
{
    use SoftDeletes;
    protected $table = 'providers';

    protected $filltable = ['name', 'code', 'price'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}
