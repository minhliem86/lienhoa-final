@extends('admin::layouts.default')

@section('content')
<!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        DASHBOARD
        <!-- <small>Optional description</small> -->
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
      <section class="thongkesp clearfix">
          <div class="row">
            <div class="col-lg-3 col-md-6 col-lg-offset-3">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>{{\lienhoa\models\Sanpham::all()->count()}}</h3>
                  <p>SẢN PHẨM</p>
                </div>
                <div class="icon">
                <i class="ion ion-bag"></i>
                </div>
                <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
              </div>
            </div>

            <div class="col-lg-3 col-md-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>{{\lienhoa\models\News::all()->count()}}</h3>
                  <p>TIN TỨC</p>
                </div>
                <div class="icon">
                <i class="fa fa-newspaper-o"></i>
                </div>
                <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
              </div>
            </div>

          </div> <!-- end row -->
      </section>

      <section class="chart">
        <div class="row">
          <div class="col-sm-12">
            <div id="curve_chart" style="width: 100%; height: 500px"></div>
          </div>
        </div>
      </section>
    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->
@stop

@section('script')
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

   <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var x = 2;
        var data = google.visualization.arrayToDataTable([
          ['Ngày', 'Khách hàng', 'Lượt xem'],
          @foreach($stats as $key=>$val)

          ['{{$arr_date[$key]}}',  {{$val[1]}},      {{$val[2]}}],
          @endforeach
        ]);

        var options = {
          title: 'Thống kê truy cập website',
          // curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
@stop