<?php 

require_once '../connection.php';

checkLogin();

$dataUserLogin = dataUserLogin();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="https://png.pngtree.com/png-clipart/20200225/original/pngtree-computer-static-graph-monitor-abstract-flat-color-icon-templa-png-image_5254061.jpg">
  
  <title>Arus & Tegangan Chart</title>

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
            <h1>Arus & Tegangan Chart</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Arus</h3>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="arusChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col (LEFT) -->
          <div class="col-md-12">
            <!-- LINE CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Tegangan</h3>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="teganganChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include_once '../include/footer.php'; ?>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script>
$(function () {
  // Get context with jQuery - using jQuery's .get() method.
  var arusChartCanvas = $('#arusChart').get(0).getContext('2d')

  var arusChartData = {
    labels  : [],
    datasets: [
      {
        label               : 'Arus',
        borderColor         : 'rgb(0,123,255)',
        pointRadius         : 5,
        pointHoverRadius    : 8,
        pointColor          : 'rgb(0,123,255)',
        pointStrokeColor    : 'rgb(0,123,255)',
        pointHighlightFill  : 'rgb(0,123,255)',
        pointHighlightStroke: 'rgb(0,123,255)',
        data                : []
      }
    ]
  }

  var arusChartOptions = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines : {
          display : true,
        }
      }],
      yAxes: [{
        gridLines : {
          display : true,
        }
      }]
    }
  }

  // This will get the first returned node in the jQuery collection.
  var arus = new Chart(arusChartCanvas, {
    type: 'line',
    data: arusChartData,
    options: arusChartOptions
  })

  // Get context with jQuery - using jQuery's .get() method.
  var teganganChartCanvas = $('#teganganChart').get(0).getContext('2d')

  var teganganChartData = {
    labels  : [],
    datasets: [
      {
        label               : 'Tegangan',
        borderColor         : 'rgb(23,162,184)',
        pointRadius         : 5,
        pointHoverRadius    : 8,
        pointColor          : 'rgb(23,162,184)',
        pointStrokeColor    : 'rgb(23,162,184)',
        pointHighlightFill  : 'rgb(23,162,184)',
        pointHighlightStroke: 'rgb(23,162,184)',
        data                : []
      }
    ]
  }

  var teganganChartOptions = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines : {
          display : true,
        }
      }],
      yAxes: [{
        gridLines : {
          display : true,
        }
      }]
    }
  }

  // This will get the first returned node in the jQuery collection.
  var tegangan = new Chart(teganganChartCanvas, {
    type: 'line',
    data: teganganChartData,
    options: teganganChartOptions
  })

  // Function to fetch data from PHP script
  function fetchDataArrayArusTegangan() {
    $.ajax({
      url: '../fetch_data_array_arus_tegangan.php',
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        arusChartData.labels = data.label_arus_tegangan_array;
        arusChartData.datasets[0].data = data.arus_array;
        arus.update();
        teganganChartData.labels = data.label_arus_tegangan_array;
        teganganChartData.datasets[0].data = data.tegangan_array;
        tegangan.update();
      },
      error: function(xhr, status, error) {
        console.error('Error fetching data:', error);
      }
    });
  }

  // Fetch data initially
  fetchDataArrayArusTegangan();

  // Fetch data every 5 seconds
  setInterval(fetchDataArrayArusTegangan, 5000);

// ----------------------------------------------------

})
</script>
</body>
</html>
