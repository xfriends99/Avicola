<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;
    protected $table = 'clients';

    protected $filltable = ['name', 'code', 'price'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}
