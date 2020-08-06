<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    protected $primaryKey = 'Menu_id';

    protected $fillable = ['Menu_id','Menu_nama','Menu_harga','Menu_Gambar','Menu_Stock'];
    public $timestamps = false;

   public function ImageCheck(){
   		if(!$this->Menu_Gambar ){
   			return asset('/MenuImages/default.png');
   		}
   		return asset('/MenuImages/'.$this->Menu_Gambar);
   }
   public function item()
   {
 		return $this->belongsToMany(Item::class, 'Item_id');
   }
   
}
