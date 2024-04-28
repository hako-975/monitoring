<?php 

require_once '../connection.php';

checkLogin();

$dataUserLogin = dataUserLogin();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Arus dan Tegangan Charts</title>
  
  <link rel="icon" href="https://png.pngtree.com/png-clipart/20200225/original/pngtree-computer-static-graph-monitor-abstract-flat-color-icon-templa-png-image_5254061.jpg">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php include_once '../include/navbar.php'; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include_once '../include/sidebar.php'; ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Arus & Tegangan Charts</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- interactive chart -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  Arus
                </h3>

                <div class="card-tools">
                  Real time
                  <div class="btn-group" id="realtime" data-toggle="btn-toggle">
                    <button type="button" class="btn btn-default btn-sm active" data-toggle="on">On</button>
                    <button type="button" class="btn btn-default btn-sm" data-toggle="off">Off</button>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div id="interactive-arus" style="height: 300px;"></div>
              </div>
              <!-- /.card-body-->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
    </section>
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- interactive chart -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  Tegangan
                </h3>

                <div class="card-tools">
                  Real time
                  <div class="btn-group" id="realtime" data-toggle="btn-toggle">
                    <button type="button" class="btn btn-default btn-sm active" data-toggle="on">On</button>
                    <button type="button" class="btn btn-default btn-sm" data-toggle="off">Off</button>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div id="interactive-tegangan" style="height: 300px;"></div>
              </div>
              <!-- /.card-body-->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
        <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include_once '../include/footer.php'; ?>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- FLOT CHARTS -->
<script src="../plugins/flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="../plugins/flot/plugins/jquery.flot.resize.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="../plugins/flot/plugins/jquery.flot.pie.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
$(function () {
  var data        = [],
      totalPoints = 100

  function getRandomData() {

    if (data.length > 0) {
      data = data.slice(1)
    }

    // Do a random walk
    while (data.length < totalPoints) {

      var prev = data.length > 0 ? data[data.length - 1] : 50,
          y    = prev + Math.random() * 10 - 5

      if (y < 0) {
        y = 0
      } else if (y > 100) {
        y = 100
      }

      data.push(y)
    }

    // Zip the generated y values with the x values
    var res = []
    for (var i = 0; i < data.length; ++i) {
      res.push([i, data[i]])
    }

    return res
  }

  var interactive_arus = $.plot('#interactive-arus', [
      {
        data: getRandomData(),
      }
    ],
    {
      grid: {
        borderColor: '#f3f3f3',
        borderWidth: 1,
        tickColor: '#f3f3f3'
      },
      series: {
        color: '#3c8dbc',
        lines: {
          lineWidth: 2,
          show: true,
          fill: true,
        },
      },
      yaxis: {
        min: 0,
        max: 100,
        show: true
      },
      xaxis: {
        show: true
      }
    }
  )

  var interactive_tegangan = $.plot('#interactive-tegangan', [
      {
        data: getRandomData(),
      }
    ],
    {
      grid: {
        borderColor: '#f3f3f3',
        borderWidth: 1,
        tickColor: '#f3f3f3'
      },
      series: {
        color: '#3c8dbc',
        lines: {
          lineWidth: 2,
          show: true,
          fill: true,
        },
      },
      yaxis: {
        min: 0,
        max: 100,
        show: true
      },
      xaxis: {
        show: true
      }
    }
  )

  var updateInterval = 500 //Fetch data ever x milliseconds
  var realtime       = 'on' //If == to on then fetch data every x seconds. else stop fetching
  function updateArus() {

    interactive_arus.setData([getRandomData()])

    // Since the axes don't change, we don't need to call plot.setupGrid()
    interactive_arus.draw()
    if (realtime === 'on') {
      setTimeout(updateArus, updateInterval)
    }
  }

  //INITIALIZE REALTIME DATA FETCHING
  if (realtime === 'on') {
    updateArus()
  }
  //REALTIME TOGGLE
  $('#realtime .btn').click(function () {
    if ($(this).data('toggle') === 'on') {
      realtime = 'on'
    }
    else {
      realtime = 'off'
    }
    updateArus()
  })

  function updateTegangan() {

    interactive_tegangan.setData([getRandomData()])

    // Since the axes don't change, we don't need to call plot.setupGrid()
    interactive_tegangan.draw()
    if (realtime === 'on') {
      setTimeout(updateTegangan, updateInterval)
    }
  }

  //INITIALIZE REALTIME DATA FETCHING
  if (realtime === 'on') {
    updateTegangan()
  }
  //REALTIME TOGGLE
  $('#realtime .btn').click(function () {
    if ($(this).data('toggle') === 'on') {
      realtime = 'on'
    }
    else {
      realtime = 'off'
    }
    updateTegangan()
  })
  /*
   * END INTERACTIVE CHART
   */
})

</script>
</body>
</html>
