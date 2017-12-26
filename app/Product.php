<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $table = 'products';

    protected $filltable = ['name', 'code', 'price', 'type_calculation', 'price_sales'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}
