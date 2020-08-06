       
@extends('layout.mainlayout')
@section('menucss')

  <link rel="stylesheet" href="/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<style >
  .group{
    margin-top: 90px;
  }
 
</style>
  @endsection
 
 @section('content')

<div class="row">
       <div class="col-md-12">
        <div class="card">
            <div class="card-header " >
             
              <h3 class="card-title" style="font-weight: bold; font-size: 22px;" >  <i class="fas fa-coffee"></i>  Data Menu</h3>
              <a  href="#"  data-toggle="modal" data-target="#exampleModal" style="font-size: 30px; margin-left: 1020px ">
              <i class="far fa-plus-square"></i>
             </a>
                  
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead style="text-align: center;">
                <tr>
                  <th >Menu Name</th>
                  <th>Price</th>
                  <th style="width: 30%">Images</th>
               <th style="width: 20%">
                      </th>
                </tr>

                </thead>
                <tbody>
                  @foreach($DataMenu as $menu_data)
                <tr>
                  <td style="text-align: center; padding-top: 100px"> {{$menu_data -> Menu_nama}}</td>
                  <td style="padding-top: 100px; text-align: center;">
                    {{"Rp ". number_format($menu_data -> Menu_harga,2,',','.')}}
                  </td>
                  <td style="text-align: center;"><img style="width: 200px;height: 200px" src="{{$menu_data->ImageCheck()}}" ></td>
                 <td class="project-actions text-center" style="">
                
                  <a class="btn btn-info btn-sm group" href="#" data-toggle="modal" data-target="{{'#modal'.$menu_data->Menu_id}}" >
                      <i class="fas fa-pencil-alt">
                      </i>
                      Edit
                  </a>
                   <form role="form" action="/menu/delete" method="POST" hidden="true" id="form{{$menu_data->Menu_id}}">
                      {{csrf_field()}}
                    <div class="form-group" hidden="true">
                  <input name="menuId" type="text" class="form-control" placeholder="" value="{{$menu_data->Menu_id}}">
                    </div>
                    </form>
                  <a class="btn btn-danger btn-sm group" type="submit" id="{{$menu_data->Menu_id}}button" style="color: white">
                      <i class="fas fa-trash">
                      </i>
                      Delete
                  </a>
               
                    </td>
                </tr>
               
                </tr>
                  @endforeach
                </tbody>
                <tfoot>
                
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
      </div> 
    </div>

   <!--  Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create New Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
              <form role="form" action="/menu/create" method="POST" enctype="multipart/form-data">
                <div class="card-body">  
                  {{csrf_field()}}
                  <div class="form-group">
                    <label for="exampleInputEmail1">Menu Name</label>
                    <input name="menuName" type="text" class="form-control" placeholder="Menu Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Price</label>
                    <input name="menuPrice" type="number" class="form-control" placeholder="Menu Price">
                  </div>
                  <div class="form-group" style="margin-bottom: 20px">
                    <label for="exampleInputFile">Image Menu File</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input name="imagefile" type="file" class="form-control" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile"></label>
                      </div>
                      <div class="input-group-append">
                       
                      </div>
                    </div>
                  </div>
                  <div class="form-group text-center" style="background-color: blue;border-radius: 10px" >
                    <label class="font-weight-bold pt-md-1" style="color: white;">Recipe</label>
                  </div>

                   @foreach($DataItem as $item_data)
                  <?php 
                    $unit= '';
                      if($item_data->Type == 'Solid'){
                      $unit ='gr'  ;
                      }
                     else{
                     $unit ='ml'  ;
                      } 

                   ?>
                  <div class="form-group row" style="margin-left: 10px">
                    <input name="checkbox[]" type="checkbox" class="form-check-input "value="{{$item_data->Item_id}}" id="{{$item_data->Item_id}}" >
                    <label class="form-check-label col-sm-6 ">{{$item_data->Item_nama}}</label>      
                     <input name="{{$item_data->Item_id}}" type="number" class="form-control"  placeholder="{{$item_data->Item_nama.' ('.$unit.')' }}" id="{{$item_data->Item_nama}}" style="width: 200px;  height: 30px;" min="0"  disabled="true"  >
                </div>
                @endforeach
                </div>
                
                <!-- /.card-body -->
              
      </div>
      <div class="modal-footer text-center">
          <button type="submit" class="btn btn-primary ">Submit</button>
      </div>
        </form>
    </div>
  </div>
</div>


 @foreach($DataMenu as $menu_data)
<div class="modal fade" id="{{'modal'.$menu_data->Menu_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{$menu_data->Menu_nama}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <!--   View -->
       <?php 
           $menu_detailwhere = $DataMenuDetail::where('Menu_id',$menu_data->Menu_id)->get();

         
           $key = array();
        
             foreach ($menu_detailwhere  as $data_item_where) {

           array_push($key,$data_item_where["Item_id"]);
            
             }
  
           $temp = array_fill_keys($key,'');         
      
             foreach ($menu_detailwhere  as $data_item_where) {
          $temp[$data_item_where["Item_id"]] = $data_item_where["Quantity_need"]; 
             }
             ?>

   <div class="form-group text-center" style="background-color: blue;border-radius: 10px" >
                    <label class="font-weight-bold pt-md-1" style="color: white;">Detail Existing Recipe</label>
                  </div>

<div class="row">
     <div class="form-group col-md-5 text-center ml-4" style=" background-color:black;border-radius: 10px;" >
 <label class="font-weight-bold pt-md-1" style="color: white;">Detail Existing Recipe</label>
      </div>
        <div class="form-group col-md-5 text-center " style="margin-left: 35px ;background-color:rgb(128,128,128);border-radius: 10px">
 <label class="font-weight-bold pt-md-1" style="color: white;">Quantity</label>
      </div>
 </div>
<div class="row">

                   
           @foreach($DataItem as $item_data)
                  <?php 
                    $unit= '';
                      if($item_data->Type == 'Solid'){
                      $unit ='gr'  ;
                      }
                     else{
                     $unit ='ml'  ;
                      } 

                   ?>
          @if(in_array(($item_data->Item_id),array_keys($temp)))
            <?php 
              $item_datawhere = $DataItemWhere::where('Item_id',$item_data->Item_id)->get();
          
             ?>

             @foreach($item_datawhere as $data_item_where)

    
           <div class="form-group col-md-6 text-center " style=" background-color:rgb(128,128,128); border-radius: 10px" >
                  <label class="form-check-label  " style="color: white;font-weight:bold;">{{$data_item_where->Item_nama}}</label> 
            </div>
            <div class="form-group col-md-6 text-center" style=" background-color:black; border-radius: 10px">
             <label class="form-check-label  " style="margin-top: 3px; color: white;font-weight:bold;">{{$temp[$data_item_where->Item_id] .' ( '.$unit.' )'}}</label> 
          </div>
            
            @endforeach 
          @endif

        @endforeach

            
  </div>



      <div class="form-group text-center" style="background-color: blue;border-radius: 10px" >
                    <label class="font-weight-bold pt-md-1" style="color: white;">Update Menu</label>
                  </div>

        <!-- Update -->         
        <form role="form" action="/menu/edit" method="POST" enctype="multipart/form-data">

        <div class="card-body">  
          {{csrf_field()}}
            <div class="form-group" hidden="true">
              <input name="menuId" type="text" class="form-control" placeholder="" value="{{$menu_data->Menu_id}}">
            </div>
            <div class="form-group" >
              <input name="menuName" type="text" class="form-control" placeholder="Menu Name" >
            </div>
            <div class="form-group" >
              <input name="menuPrice" type="number" class="form-control" placeholder="Menu Price" >
            </div>
            <div class="input-group">
              <div class="custom-file">
                <input name="imagefile" type="file" class="form-control" id="label-file">
                <label class="custom-file-label" for="label-file"></label>
              </div>
              </div>

            <div class="form-group text-center" style="background-color: blue;border-radius: 10px; margin-top: 10px" >
                    <label class="font-weight-bold pt-md-1" style="color: white;">Update Menu Recipe</label>
                  </div>
              
              <?php 
           $menu_detailwhere = $DataMenuDetail::where('Menu_id',$menu_data->Menu_id)->get();
           $temp = array();
      
             foreach ($menu_detailwhere  as $data_item_where) {
             array_push($temp,$data_item_where['Item_id']);
          
             }

             ?>



        @foreach($DataItem as $item_data)
                  <?php 
                    $unit= '';
                      if($item_data->Type == 'Solid'){
                      $unit ='gr'  ;
                      }
                     else{
                     $unit ='ml'  ;
                      } 

                   ?>
          @if(in_array($item_data->Item_id, $temp))
            <?php 
              $item_datawhere = $DataItemWhere::where('Item_id',$item_data->Item_id)->get();
          
             ?>

             @foreach($item_datawhere as $data_item_where)
   
           <div class="form-group" >
              <input name="ItemUpdate{{$data_item_where->Item_id}}" type="text" class="form-control" placeholder="{{$data_item_where->Item_nama .' ('.$unit.')'}}" >
               
            </div>
            @endforeach 

             @else

              <div class="form-group row" style="margin-left: 10px">
                    <input name="checkbox[]" type="checkbox" class="form-check-input "value="{{$item_data->Item_id}}" id="{{$item_data->Item_id}}-{{$menu_data->Menu_id}}-checkbox" >
                    <label class="form-check-label col-sm-6 ">{{$item_data->Item_nama}}</label>      
                     <input name="{{$item_data->Item_id}}" type="number" class="form-control"  placeholder="{{$item_data->Item_nama.' ('.$unit.')' }}" id="{{$item_data->Item_nama}}-{{$menu_data->Menu_id}}-id" style="width: 200px;  height: 30px;" min="0"  disabled="true"  >
                </div>
          @endif
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
</div>
 @endforeach





        
 @endsection
  @section('chart')
 <script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/adminlte/dist/js/demo.js"></script>
<!-- page script -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
  $(function () {
    $("#example1").DataTable({
       "lengthMenu": [[5,10,20, -1], [5,10,20, "All"]],
   "columnDefs": [
    { "orderable": false, "targets": [2,3] }
  ],
   "language": {
            "lengthMenu": "Show Entries_MENU_",
        }
    });
  });
</script>

 <script type="text/javascript">
      var array= [];
      var data = <?php echo json_encode($DataItem);  ?>;
   
 
  

for (var i = 0; i < data.length; i++) {
       var datatemp = data[i];
    validationCheckBox(String(datatemp["Item_id"]),String(datatemp["Item_nama"]));
    
    }
   
function validationCheckBox(checkbox_id, quantity_id) {
  var checkbox = document.getElementById(checkbox_id);  
 
      checkbox.addEventListener("click", function(){
           var quantity = document.getElementById(quantity_id);
  
       if(checkbox.checked == true){

         quantity.disabled= false;

                  
       }else{
      
           quantity.disabled= true;
           quantity.value = '';
     
       }
      })
}

var dataMenuid = <?php echo json_encode($DataMenu);  ?>;
var dataMenuidxx = <?php echo json_encode($temp);  ?>;


for (var i = 0; i < dataMenuid.length; i++) {
    var datatempMenuid = dataMenuid[i];
  for (var a = 0; a < data.length; a++) {
       var datatemp = data[a];
      

    validationCheckBox2(String(datatemp["Item_id"])+"-"+String(datatempMenuid["Menu_id"])+"-"+"checkbox",String(datatemp["Item_nama"])+"-"+String(datatempMenuid["Menu_id"])+"-"+"id");
    
  
    }
    
  }
function validationCheckBox2(checkbox_id, quantity_id) {
  
  var checkbox = document.getElementById(checkbox_id);  
  if(checkbox != null){
   
 
      checkbox.addEventListener("click", function(){
           var quantity = document.getElementById(quantity_id);
  
       if(checkbox.checked == true){

         quantity.disabled= false;

                  
       }else{
      
           quantity.disabled= true;
           quantity.value = '';
       }
      })
    }
}





for (var i = 0; i < dataMenuid.length; i++) {
   var datatempMenuid = dataMenuid[i];
    validationButton(String(datatempMenuid["Menu_id"])+"button","form"+String(datatempMenuid["Menu_id"]));
   
 }



function validationButton(button_id, form_id) {
  var button = document.getElementById(button_id);  
  if(button != null){
      button.addEventListener("click", function(){
           var form = document.getElementById(form_id);
        
       swal("Are you sure you want to do this?", {
  buttons: {
    No: "No",
    Yes: "Yes",
  
  },
})
.then((value) => {
  switch (value) {
 
    case "Yes":
   form.submit();
      break;
 
  
      
  }
});
      })
    }
}
  
  



</script>
@endsection


