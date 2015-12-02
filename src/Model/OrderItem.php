<?php

namespace Trexology\LaravelOrder\Model;


use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model{

    protected $table = 'orderItems';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
