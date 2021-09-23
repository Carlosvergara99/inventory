<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inventory extends Model
{
    protected $table = 'inventories';
    protected $guarded = ['id'];
  
    
    public function products()
    {
        return $this->belongsToMany('App\product', 'inventories_products');
    }
}
