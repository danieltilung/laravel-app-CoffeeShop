<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Item;
use App\Menudetail;

class AdminController extends Controller
{
    public function dashboard(){

 	 $Item = Item::all();
 	 //$Menudetail = Menudetail::all();

 	 $ItemStock1000 = array();

 	 foreach ($Item as $itemarray) {
 	 array_push($ItemStock1000, 100000);	
 	 }

 	 $ItemArr = [];
 	 foreach ($Item as $itemarray) {
 	 	$ItemArr[] = $itemarray->Item_nama;
 	 }
		$StockArr =[];
		foreach ($Item as $stockarray) {
			$StockArr[] =($stockarray->Item_stock)/100000 * 100;
		}

		$StockArray =[];
		foreach ($Item as $stockarray1) {
			$StockArray[] =$stockarray1->Item_stock;
		}
	
    	return view('Admin.dashboard',compact('Item'),compact('ItemArr'))
    	->with(compact('StockArr'))
    	->with(compact('ItemStock1000'))
    	->with(compact('StockArray'));
    }
}
