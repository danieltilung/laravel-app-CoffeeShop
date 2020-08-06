<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\Order;
use App\Item;
use App\MenuDetail;
use App\Payment;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

  public function order(){
$DataMenu = Menu::all();
$DataOrderall = new Order;

 $DataOrder = Order::select('Order_customer',DB::raw('SUM(Total_price) as Total_price'),DB::raw('COUNT(Menu_id) as Menu_id_Count'))->where('Order_status','MasihDibuat')
                ->groupBy('Order_customer')->get();
  

   	return view('/order',compact('DataMenu'))
    ->with(compact('DataOrder'))
    ->with(compact('DataOrderall'));
   }

  public function createorder(Request $request){
  		$order = new Order;
    $DataMenu = Menu::all();
$DataItem = Item::all();


      $Itemwhere = MenuDetail::where('Menu_id',$request->select)->get();
      $arr =array();
      $needs =array();

      foreach ($Itemwhere as $value) {
             array_push($arr,$value->Item_id);
              array_push($needs,$value->Quantity_need);
           }     
 $count = 0;

if($arr != null){
 foreach ($DataItem as $item_data) {
           if(in_array( $item_data->Item_id,$arr)){

            if($needs[$count] < $item_data->Item_stock){
       DB::table('items')->where('Item_id',$item_data->Item_id)->update([
        'Item_stock' => ($item_data->Item_stock - $needs[$count] * $request->Quantity)
        ]);
       $count++;
            }
            else{
              //dd($needs[$count]);
  return redirect()->back()->with('alert', 'Not Enough Stock');
            }

           }  
}
}

  		$order->Menu_id = $request->select;
  		$order->Order_quantity= $request->Quantity;
  		$order->Order_status= 'MasihDibuat';
      $order->Order_customer= $request->customer_name;
      $order->Total_price= $request->totalprice;
  		$order->save();


 return redirect('order');


   }

public function payment(Request $request){

$Updateorder =Order::where('Order_customer',$request->ordername)->get();

foreach ($Updateorder as $value) {
  DB::table('orders')->where('Order_customer',$request->ordername)->update([
        'Order_status' => 'Sudah Selesai'
        ]);
}
$payment = new Payment;

$payment->Metode_pembayaran = $request->select;
$payment->Total_Pembayaran = $request ->totalprice;
$payment->Order_customer= $request->ordername;
$payment->save();

  return redirect('order');
}
  



}
