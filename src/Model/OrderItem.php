<?php
/**
 * Created by PhpStorm.
 * User: ray
 * Date: 15/7/27
 * Time: 上午11:11
 */

namespace Trexology\LaravelOrder\Model;


use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model{

    protected $table = 'orderItems';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
