<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\Item;
use App\MenuDetail;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
     public function menu(){
     	$DataMenu = Menu::all();
     	$DataItem= Item::all();
     	$DataMenuDetail = new MenuDetail;
     	$DataItemWhere = new Item;
     
     
   		return view('Menu',compact('DataMenu'),compact('DataItem'))
   		->with(compact('DataMenuDetail'))
   		->with(compact('DataItemWhere'));
   }

   public function create(Request $request){
   	
 	$menudetail = new MenuDetail;
 	
   	$menu = new Menu;
   	$menu->Menu_nama = $request->menuName;
   	$menu->Menu_harga = $request->menuPrice;
   	if($request->hasfile('imagefile')){
   		

   		$request->file('imagefile')->move(base_path('public/MenuImages/'),$request->file('imagefile')->getClientOriginalName());
   		
   		$menu->Menu_Gambar = $request->file('imagefile')->getClientOriginalName();
   	}

	$menu->save();

	$Menu_id = $menu->Menu_id;


if($request->has('checkbox')){
$temp = $request->checkbox;
$finalArray = array();
foreach($temp as $value){
   array_push($finalArray, array(
                'Menu_id'=>$Menu_id,
                'Item_id'=>$value,
                'Quantity_need'=>$request->$value 
            ));
}

MenuDetail::insert($finalArray);
}

	return redirect('menu');

   	  }
public function edit(Request $request){
	 $menu = Menu::find($request->menuId);

	if($request->menuname != null ){
   	$menu->Menu_nama = $request->menuName;
	}
	if($request->menuPrice != null ){
   	$menu->Menu_harga = $request->menuPrice;
   	}
   	if($request->hasfile('imagefile')){
   		

   		$request->file('imagefile')->move(base_path('public/MenuImages/'),$request->file('imagefile')->getClientOriginalName());
   		
   		$menu->Menu_Gambar = $request->file('imagefile')->getClientOriginalName();
   	}
	$menu->save();

	$menudetail = MenuDetail::where('Menu_Id',$request->menuId)->get();

	

	foreach ($menudetail as $value) {
		$tempstring = 'ItemUpdate'.$value['Item_id'];
		if($request->$tempstring!= null){
			if($request->$tempstring == 0){
				DB::table('menudetails')->where('Menu_id',$request->menuId)->where('Item_id',$value['Item_id'])->delete();
			}else{
			DB::table('menudetails')->where('Menu_id',$request->menuId)->where('Item_id',$value['Item_id'])->update([
			'Quantity_need' => $request->$tempstring
					]);
			}
		}
		
	}


if($request->has('checkbox')){
$temp = $request->checkbox;
$finalArray = array();
foreach($temp as $value){
   array_push($finalArray, array(
                'Menu_id'=>$request->menuId,
                'Item_id'=>$value,
                'Quantity_need'=>$request->$value 
            ));
}

MenuDetail::insert($finalArray);
}
	

return redirect('menu');

}

public function delete(Request $request){

$menu = Menu::find($request->menuId);

DB::table('menudetails')->where('Menu_id',$request->menuId)->delete();
DB::table('menus')->where('Menu_id',$request->menuId)->delete();

return redirect('menu');

}


}
