@extends('layout.mainlayout')
 @section('content')
 <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Order Form</h3>
              </div>
              <div class="card-body">
               
                    <form action="/warehouse/create" method="POST">
                            {{csrf_field()}}

              <div class="input-group mb-3 text-center">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Customer Name</span>
                  </div>
                    <input name="Item_name" type="text" class="form-control " placeholder="" id="customer" >
                </div>
                 <div class="input-group mb-3 text-center">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Item_Stock</span>
                  </div>
                    <input name="Item_stock" type="text" class="form-control " placeholder="" id="customer" >
                </div>
                 <div class="input-group mb-3 text-center">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Type</span>
                  </div>
                    <input name="Item_type" type="text" class="form-control " placeholder="" id="customer" >
                </div>
                <!-- /input-group -->
                </div>

              <!-- /.card-body -->
               <div class="card-footer">
                  <button class="btn btn-info" type="submit">Add Item</button>
                </div>
            </div>
        </form>
 @endsection