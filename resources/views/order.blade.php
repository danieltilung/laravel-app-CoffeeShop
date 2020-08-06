@extends('layout.mainlayout')
 @section('content')
  <div class="row">
  <div class="col-md-4">
 <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Order Form</h3>
              </div>
              <div class="card-body">
               
                    <form action="/order/createorder" method="POST">
                            {{csrf_field()}}

              <div class="input-group mb-3 text-center">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Customer Name</span>
                  </div>
                    <input name="customer_name" type="text" class="form-control " placeholder="" id="customer" >
                </div>
                     
                     <div class="form-group mb-3">
                        <select class="form-control" name="select" id="select" onchange="myFunction()">
                          <option value="Menu">MenuName</option>
                          @foreach($DataMenu as $menu_data)
                          <option id="{{$menu_data->Menu_nama}}" value="{{$menu_data->Menu_id}}">{{$menu_data->Menu_nama}}</option>
                        @endforeach
                      </select>
                      </div>
       

                <div class="input-group mb-3 text-center">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Rp</span>
                  </div>
                
                  <input disabled="true" type="number" class="form-control " placeholder="" id="price" >
 
                </div>

            <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Quantity</span>
                  </div>
                
                  <input type="number" class="form-control" placeholder=""  id="qty" oninput="OnInputFunction()" name="Quantity">
 
                </div>

            <div class="input-group mb-3" >
                  <div class="input-group-prepend">
                    <span class="input-group-text">Total Price ( Rp ) </span>
                  </div>
                
                  <input  readonly="true" type="number" class="form-control" placeholder="" id="totalprice" name="totalprice" >
 
                </div>

             
                
                <!-- /input-group -->
                </div>

              <!-- /.card-body -->
               <div class="card-footer">
                  <button class="btn btn-info" type="submit">Add Order</button>
                </div>
            </div>
             </form>
         </div>
        <div class="col-md-8">
                     <div class="card">
              <div class="card-header">
                <h3 class="card-title">Order List</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body ">
                <table class="table table-hover" id="table">
                  <thead>
                    <tr>
                      <th>CustomerName</th>
                      <th>Total Price</th>
                      <th>DataMenuCount</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($DataOrder as $order_data)
                   <tr>
                      <td><a href="" data-toggle="modal" data-target="{{'#modal'.$order_data->Order_customer}}">{{$order_data->Order_customer}}</a></td>
                      <td>{{$order_data->Total_price}}</td>
                      <td>{{$order_data->Menu_id_Count}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
       </div>

@foreach($DataOrder as $order_data)
<div class="modal fade" id="{{'modal'.$order_data->Order_customer}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{$order_data->Order_customer}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="form-group text-center" style=" background-color:black;border-radius: 10px;" >
        <label class="font-weight-bold pt-md-1" style="color: white;">Payment</label>
      </div> 
      
      <?php 
   
      $DataOrderwhere = $DataOrderall::where('Order_customer',$order_data->Order_customer)->get();  

      $key = array();
        
        foreach ($DataOrderwhere as $data_order) {

           array_push($key,$data_order["Menu_id"]);
            
             }
             $temp = array_fill_keys($key,'');  

       foreach($DataOrderwhere as $data_order){
       $temp[$data_order["Menu_id"]] = $data_order["Order_quantity"];
       } 
       ?>

<div class="row">
      @foreach($DataMenu as $data_menu)
      @if(in_array($data_menu->Menu_id,array_keys($temp)))
      <div class="col-md-6">
     
        <div class="form-group" >
              <input name="ordername" type="text" class="form-control text-center" placeholder="" value="{{$data_menu->Menu_nama}}" disabled="true">
            </div>
            </div>
               <div class="col-md-6">
              <div class="form-group" >
              <input name="ordername" type="text" class="form-control text-center" placeholder="" value="{{$temp[$data_menu->Menu_id]}}" disabled="true">
            </div>
          </div>
      @endif

      @endforeach
      </div>

      <form role="form" action="/order/payment" method="POST" enctype="multipart/form-data">
       {{csrf_field()}}
            <div class="form-group" hidden="true">
              <input name="ordername" type="text" class="form-control" placeholder="" value="{{$order_data->Order_customer}}">
            </div>
           <div class="form-group" >
              <select class="form-control" name="select" id="select" onchange="myFunction()">
                <option value="Cash">Cash</option>
                 <option value="Debet">Debet</option>
            </select>
          </div>
            @foreach($DataOrder as $order_data)
                   <input name="totalprice" type="text" class="form-control" placeholder="" value="{{$order_data->Total_price}}">
                    @endforeach

      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
           </form>      
    </div>
  </div>
</div>
 @endforeach

@if (session('alert'))
    <div class="alert alert-danger">
        {{ session('alert') }}
    </div>
@endif

  @endsection
  @section('chart')
<script>

   var dataMenu = <?php echo json_encode($DataMenu);  ?>;

  function myFunction(){
    var x = document.getElementById("select").value;
    if(x =="Menu" ){
        document.getElementById("price").value = '';
    }
  else{
    for (var i = 0; i < dataMenu.length; i++) {
     var datatempMenu = dataMenu[i];
  
     if(datatempMenu['Menu_id'] == x){
    document.getElementById("price").value = datatempMenu['Menu_harga'];
      }
    }
    }
}


function OnInputFunction(){
  var x = document.getElementById("price").value;
   var y = document.getElementById("qty").value;
  var multiply = x * y;
  document.getElementById("totalprice").value = multiply;
}





</script>

  @endsection