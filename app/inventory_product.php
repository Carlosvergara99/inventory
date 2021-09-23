<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inventory_product extends Model
{
    protected $table = 'inventories_products';
    protected $guarded = ['id'];
}
