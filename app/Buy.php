<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buy extends Model
{
    use SoftDeletes;
    protected $table = 'buy';

	protected $filltable = ['code', 'price','price_total','status_pay', 'type_product','quantity','quantity_weight','type_price','date_credit','date_pay'];

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}
