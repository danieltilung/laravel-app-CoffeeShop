<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuDetail extends Model
{
protected $primaryKey = null;
    public $incrementing = false;
	 protected $table = 'menudetails';
    protected $fillable = ['Item_id','Menu_id','Quantity_need'];
      public $timestamps = false;
}
