       
@extends('layout.mainlayout')
@section('contentheader')
     <?php foreach($Item as $items)
      {
    $allitems[] = $items->Item_nama;
        } ?> 

        <div class="row mb-2">
          <div class="col-sm-12">  
            
            <h2 class="text-center font-weight-bold">Dashboard</h2>
     
          </div>
         <!--  <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div> -->
        </div>
   @endsection
    @section('pushmenu')
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      @endsection
   @section('content')
    
        <div class="row">
          <div class="col-md-6" >
            <!-- AREA CHART -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Stock Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body" id="table-refresh">
                <div id="chartstock">
                  <!-- <canvas id="chartstock" style="height:250px; min-height:250px"></canvas> -->
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            </div>
            <div class="col-md-6">
                      <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Stock Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body" id="table-refresh">
                <div id="container">
                  <!-- <canvas id="chartstock" style="height:250px; min-height:250px"></canvas> -->
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            </div>

          </div>
        
      @endsection
      @section('chart')
     <!--  <script src="/adminlte/js/chart.js/Chart.min.js"></script> -->
      <script src="https://code.highcharts.com/highcharts.js"></script>
<script >
Highcharts.chart('container', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Need chart'
    },
    xAxis: {
        categories: {!!json_encode($ItemArr)!!}
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Total fruit consumption'
        }
    },
    legend: {
        reversed: true
    },
    plotOptions: {
        series: {
            stacking: 'normal'
        }
    },
    series: [{
        name: 'John',
        data: {!! json_encode($StockArray) !!}
    }, {
        name: 'Jane',
        data: {!! json_encode($ItemStock1000) !!}
    }, {
        name: 'Joe',
        data: [5, 3, 4, 7, 2]
    }]
});
   Highcharts.chart('chartstock', {
    chart: {
        type: 'column',
      
    },
    
    title: {
        text: 'Stock Kitchen Coffee In'
    },
    
    xAxis: {
        categories: {!!json_encode($ItemArr)!!},
        crosshair: true
    },
    yAxis: {
        min: 0,
        max:100,
        title: {
            text: 'Stock (%)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} %</b></td></tr>'+
            '<td style="padding:0"><b></b></td></tr>'
              ,
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Stock',
        data: {!! json_encode($StockArr) !!}

    }]
});
 



</script> 
      @endsection