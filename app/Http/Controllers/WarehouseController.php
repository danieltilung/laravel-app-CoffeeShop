<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class WarehouseController extends Controller
{
    //
    public function warehouse(){
    	
    	return view('warehouse');
    }

    public function createwarehouse(Request $request)
	{
		$Item = new Item;
    	$Item->Item_nama= $request->Item_name;
    	$Item->Item_stock=$request->Item_stock;
    	$Item->Type = $request->Item_type;
    	$Item->save();

    	return redirect('warehouse');
    	}
}
