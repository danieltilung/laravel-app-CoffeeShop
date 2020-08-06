<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //

     protected $primaryKey = 'Item_id';
     protected $fillable = ['Item_id','Item_nama','Item_stock','Type'];
    public $timestamps = false;

     public function menu()
   {
 		return $this->belongsToMany(Menu::class,'Menu_id');
   }
}
