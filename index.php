<?php 

require_once 'connection.php';

checkLogin();

$dataUserLogin = dataUserLogin();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Monitoring</title>
  <?php include_once 'include/head.php'; ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
 <!--  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="https://png.pngtree.com/png-clipart/20200225/original/pngtree-computer-static-graph-monitor-abstract-flat-color-icon-templa-png-image_5254061.jpg" alt="AdminLTELogo" height="60" width="60">
  </div>
 -->
  <!-- Navbar -->
  <?php include_once 'include/navbar.php'; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include_once 'include/sidebar.php'; ?>
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3 id="temperature">N/A</h3>
                <p>Suhu</p>
              </div>
              <div class="icon">
                <i class="fas fa-temperature-high"></i>
              </div>
              <a href="<?= implode('/', array_slice(explode('/', rtrim($_SERVER['PHP_SELF'], '/')), 0, 2)) . '/'; ?>tables/suhu_dan_kelembaban_table.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3 id="humidity">N/A</h3>
                <p>Kelembaban</p>
              </div>
              <div class="icon">
                <i class="fas fa-water"></i>
              </div>
              <a href="<?= implode('/', array_slice(explode('/', rtrim($_SERVER['PHP_SELF'], '/')), 0, 2)) . '/'; ?>tables/suhu_dan_kelembaban_table.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 id="arus">N/A</h3>
                <p>Arus</p>
              </div>
              <div class="icon">
                <i class="fas fa-bolt"></i>
              </div>
              <a href="<?= implode('/', array_slice(explode('/', rtrim($_SERVER['PHP_SELF'], '/')), 0, 2)) . '/'; ?>tables/arus_dan_tegangan_table.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3 id="tegangan">N/A</h3>
                <p>Tegangan</p>
              </div>
              <div class="icon">
                <i class="fas fa-car-battery"></i>
              </div>
              <a href="<?= implode('/', array_slice(explode('/', rtrim($_SERVER['PHP_SELF'], '/')), 0, 2)) . '/'; ?>tables/arus_dan_tegangan_table.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-line mr-1"></i>
                  Suhu dan Kelembaban
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                  <!-- Morris chart - Sales -->
                  <div class="chart" id="suhu-kelembaban-chart" style="position: relative; height: 300px;">
                    <canvas id="suhu-kelembaban-chart-canvas" height="300" style="height: 300px;"></canvas>
                  </div>
              </div><!-- /.card-body -->
            <!-- /.card -->
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-12 connectedSortable">
             <!-- solid sales graph -->
             <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-line mr-1"></i>
                  Arus dan Tegangan 
                </h3>
              </div>
              <div class="card-body">
                <div class="chart" id="arus-tegangan-chart" style="position: relative; height: 300px;">
                    <canvas id="arus-tegangan-chart-canvas" height="300" style="height: 300px;"></canvas>
                  </div>
              </div>
            </div>
            <!-- /.card -->
          </section>
          <!-- right col -->
          <section class="col-lg-12 connectedSortable">
            <!-- Calendar -->
            <div class="card bg-gradient-success">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="far fa-calendar-alt"></i>
                  Calendar
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body pt-0">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
              </div>
              <!-- /.card-body -->
            </div>
          </section>

          
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  
  <!-- /.content-wrapper -->
  <?php include_once 'include/footer.php'; ?>

</div>
<!-- ./wrapper -->
<?php include_once 'include/script.php'; ?>

<script>
// Function to fetch data from PHP script
function fetchData() {
  $.ajax({
    url: 'fetch_data.php',
    type: 'GET',
    dataType: 'json',
    success: function(data) {
      $('#temperature').text(data.temperature + ' °C');
      $('#humidity').text(data.humidity + ' %');
      $('#tegangan').text(data.tegangan + ' V');
      $('#arus').text(data.arus + ' A');
    },
    error: function(xhr, status, error) {
      console.error('Error fetching data:', error);
    }
  });
}

// Fetch data initially
fetchData();

// Fetch data every 5 seconds
setInterval(fetchData, 5000);
</script>

<script>
$(function () {
  'use strict'
  // chart
  var suhuKelembabanCanvas = document.getElementById('suhu-kelembaban-chart-canvas').getContext('2d')

  var suhuKelembabanData = {
    labels: [],
    datasets: [
      {
        label: 'Suhu',
        backgroundColor: 'rgba(60,141,188,0.6)',
        borderColor: 'rgba(60,141,188,1)',
        pointRadius: 5,
        pointHoverRadius: 8,
        data: []
      },
      {
        label: 'Kelembaban',
        backgroundColor: 'rgba(40,167,69,0.6)',
        borderColor: 'rgba(36,150,62,1)',
        pointRadius: 5,
        pointHoverRadius: 8,
        data: []
      }
    ]
  }

  var suhuKelembabanOptions = {
    maintainAspectRatio: false,
    responsive: true,
    legend: {
      display: true
    },
    scales: {
      xAxes: [{
        gridLines: {
          display: true
        }
      }],
      yAxes: [{
        gridLines: {
          display: true
        }
      }]
    }, 
    elements: {
      line: {
        tension: 0 
      }
    }
  }

  // This will get the first returned node in the jQuery collection.
  // eslint-disable-next-line no-unused-vars
  var suhuKelembaban = new Chart(suhuKelembabanCanvas, { // lgtm[js/unused-local-variable]
    type: 'line',
    data: suhuKelembabanData,
    options: suhuKelembabanOptions
  })

  // Function to fetch data from PHP script
  function fetchDataArraySuhuKelembaban() {
    $.ajax({
      url: 'fetch_data_array_suhu_kelembaban.php',
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        suhuKelembabanData.labels = data.label_suhu_kelembaban_array;
        suhuKelembabanData.datasets[0].data = data.temperature_array;
        suhuKelembabanData.datasets[1].data = data.humidity_array;
        suhuKelembaban.update()
      },
      error: function(xhr, status, error) {
        console.error('Error fetching data:', error);
      }
    });
  }

  // Fetch data initially
  fetchDataArraySuhuKelembaban();

  // Fetch data every 5 seconds
  setInterval(fetchDataArraySuhuKelembaban, 5000);

// ----------------------------------------------------

  // chart
  var arusTeganganCanvas = document.getElementById('arus-tegangan-chart-canvas').getContext('2d')

  var arusTeganganData = {
    labels: [],
    datasets: [
      {
        label: 'Arus',
        backgroundColor: 'rgba(255,193,7,0.6)',
        borderColor: 'rgba(229,173,6,1)',
        pointRadius: 5,
        pointHoverRadius: 8,
        data: []
      },
      {
        label: 'Tegangan',
        backgroundColor: 'rgba(220,53,69,0.6)',
        borderColor: 'rgba(220,53,69,1)',
        pointRadius: 5,
        pointHoverRadius: 8,
        data: []
      }
    ]
  }

  var arusTeganganOptions = {
    maintainAspectRatio: false,
    responsive: true,
    legend: {
      display: true
    },
    scales: {
      xAxes: [{
        gridLines: {
          display: true
        }
      }],
      yAxes: [{
        gridLines: {
          display: true
        }
      }]
    }, 
    elements: {
      line: {
        tension: 0 
      }
    }
  }

  // This will get the first returned node in the jQuery collection.
  // eslint-disable-next-line no-unused-vars
  var arusTegangan = new Chart(arusTeganganCanvas, { // lgtm[js/unused-local-variable]
    type: 'line',
    data: arusTeganganData,
    options: arusTeganganOptions
  })

  // Function to fetch data from PHP script
  function fetchDataArrayArusTegangan() {
    $.ajax({
      url: 'fetch_data_array_arus_tegangan.php',
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        arusTeganganData.labels = data.label_arus_tegangan_array;
        arusTeganganData.datasets[0].data = data.arus_array;
        arusTeganganData.datasets[1].data = data.tegangan_array;
        arusTegangan.update()
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
})

</script>

</body>
</html>
