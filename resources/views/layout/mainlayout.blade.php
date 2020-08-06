<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Coffee In</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/adminlte/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  @yield('menucss')
  <style>
   .nav .nav-item{
border: 2px solid;
border-radius: 5px;
background-color: white;
border-color: gray;

    }

 

  </style>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper" style="">
 <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      @yield('pushmenu')
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../../index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

  

     <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item ">
        <a class="nav-link" href="/logout">
        <i class="fas fa-sign-out-alt"></i>
         
        </a>
        
      </li>
     
    </ul>
    
  </nav> -->
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary bg-dark elevation-4" style="background: url(/adminlte/dist/img/kopi.jpg); background-repeat: no-repeat; background-attachment:fixed ;
  background-size: 100% 100%; background-position: -300px; ">
    <!-- Brand Logo -->
   <!--   <div class="sidebar">
     
       </div>
 -->

    <!-- Sidebar -->
    <div class="sidebar" >
      <!-- Sidebar user (optional) -->
    <!--   <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> -->
      <div class="user-panel mt-3 ml-3 pb-3 d-flex" >
      <img src="/adminlte/dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="img-circle elevation-3"
           style="opacity: .8">
      <span class=" text-center text-light font-weight-normal ml-2 mt-1">Dashboard Menu</span>
       </div>
       <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <span class="d-block text-center text-light font-weight-normal ">{{auth()->user()->name}}</span>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item mb-2 mt-2 " >
            <a href="/dashboard" class="nav-link">
          <i class="nav-icon fas fa-chart-line"></i>
              <p style="font-weight: bold; font-size: 20px">
               Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item mb-2  ">
            <a href="/menu" class="nav-link">
             <i class="nav-icon fas fa-coffee "></i>
              <p style="font-weight: bold; font-size: 20px">
               Product
              </p>
            </a>
          </li>
          <li class="nav-item mb-2 " >
            <a href="/order" class="nav-link">
              <i class="nav-icon fas fa-cash-register "></i>
              <p style="font-weight: bold;font-size: 20px">
                Order
              </p>
            </a>
          </li>
          <li class="nav-item " >
            <a href="/warehouse" class="nav-link">
              <i class="nav-icon fas fa-warehouse "></i>
              <p style="font-weight: bold;font-size: 20px">
                Warehouse
              </p>
            </a>
          </li>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="height: auto;" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
          @yield('contentheader')
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content" style="padding-bottom: 100px">
<div class="container-fluid">
     @yield('content')
</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer" >
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.0-rc.3
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/adminlte/js/demo.js"></script>
@yield('chart')
</body>
</html>


