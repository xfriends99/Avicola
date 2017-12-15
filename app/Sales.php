<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sales extends Model
{
    use SoftDeletes;
    protected $table = 'sales';

	protected $filltable = ['code', 'price_unity','price_total' ,'type_product','service','status','status_payment','date_payment','price_buy_zoo','quantity_dead','quantity','service','status','date_credit','date_payment','merma','weight'];

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}
