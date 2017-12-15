<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Services extends Model
{
    use SoftDeletes;
    protected $table = 'services';

	protected $filltable = ['name', 'code', 'price', 'type_calculation'];

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}
