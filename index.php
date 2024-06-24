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
  <style>
    .compass {
      width: 300px;
      height: 300px;
      background-image: url('dist/img/background.png');
      background-size: cover;
      position: relative;
      text-align: center;
      margin: auto;
    }

    .needle {
      position: absolute;
      width: 25px;
      height: 120px;
      background-image: url('dist/img/arrow.png'); 
      background-size: contain;
      background-repeat: no-repeat;
      background-position: center;
      transition: transform 0.5s ease;
      margin: auto;
      top: 50%;
      margin-top: -120px;
      left: 50%;
      transform-origin: 50% 100%;
      transform: translateX(-50%) rotate(0deg);
    }


    .buttons {
      margin-top: 20px;
    }

    button {
      margin: 5px;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="https://png.pngtree.com/png-clipart/20200225/original/pngtree-computer-static-graph-monitor-abstract-flat-color-icon-templa-png-image_5254061.jpg" alt="AdminLTELogo" height="60" width="60">
  </div> -->

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
          <div class="col-sm-6 my-auto">
            <h1 class="my-auto">Dashboard</h1>
          </div>
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
              <a href="tables/suhu_dan_kelembaban_table.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
              <a href="tables/suhu_dan_kelembaban_table.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
              <a href="tables/arus_dan_tegangan_table.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
              <a href="tables/arus_dan_tegangan_table.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <div class="row mb-3">
          <div class="col">
            <div class="card mb-3">
              <div class="row no-gutters">
                <div class="col-md-5 p-4">
                  <div class="compass">
                    <div id="direction" class="needle"></div>
                  </div>
                </div>
                <div class="col-md-7">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-12 p-3 border">
                        <h4 class="mb-0 font-weight-bold">Dual Axis Solar Tracker</h4>
                      </div>
                      <div class="col-6 border p-3">Left Top (LT): <strong id="ldr_lt"></strong> (unit)</div>
                      <div class="col-6 border p-3">Right Top (RT): <strong id="ldr_rt"></strong> (unit)</div>
                      <div class="col-6 border p-3">Left Down (LD): <strong id="ldr_ld"></strong> (unit)</div>
                      <div class="col-6 border p-3">Right Down (RD): <strong id="ldr_rd"></strong> (unit)</div>
                      <div class="col-6 border p-3">Servo Horizontal: <strong id="servo_h"></strong> (derajat)</div>
                      <div class="col-6 border p-3">Servo Vertical: <strong id="servo_v"></strong> (derajat)</div>
                      <div class="col-12 border p-3">Create At: <strong id="create_at"></strong></div>
                    </div>  
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Main row -->
        <div class="row">
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header row">
                <div class="col my-auto">
                  <h3 class="card-title my-auto">
                    <i class="fas fa-chart-line mr-1"></i>
                     Dual Axis Solar Tracker
                  </h3>
                </div>
                <div class="col-sm-6 my-auto text-right">
                  <div class="btn-group my-auto" role="group" aria-label="Time Interval Buttons">
                    <button type="button" class="btn btn-primary">15 Menit</button>
                    <button type="button" class="btn btn-primary">1 Jam</button>
                    <button type="button" class="btn btn-primary">4 Jam</button>
                    <button type="button" class="btn btn-primary">1 Hari</button>
                    <button type="button" class="btn btn-primary">1 Bulan</button>
                  </div>
                </div>  
              </div><!-- /.card-header -->
              <div class="card-body">
                  <!-- Morris chart - Sales -->
                  <div class="chart" id="dual-axis-solar-tracker-chart" style="position: relative; height: 300px;">
                    <canvas id="dual-axis-solar-tracker-chart-canvas" height="300" style="height: 300px;"></canvas>
                  </div>
              </div><!-- /.card-body -->
            <!-- /.card -->
            </div>
            <!-- /.card -->
          </section>

          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header row">
                <div class="col my-auto">
                  <h3 class="card-title my-auto">
                    <i class="fas fa-chart-line mr-1"></i>
                    Suhu dan Kelembaban
                  </h3>
                </div>
                <div class="col-sm-6 my-auto text-right">
                  <div class="btn-group my-auto" role="group" aria-label="Time Interval Buttons">
                    <button type="button" class="btn btn-primary">15 Menit</button>
                    <button type="button" class="btn btn-primary">1 Jam</button>
                    <button type="button" class="btn btn-primary">4 Jam</button>
                    <button type="button" class="btn btn-primary">1 Hari</button>
                    <button type="button" class="btn btn-primary">1 Bulan</button>
                  </div>
                </div>  
              </div>
             <!-- /.card-header -->
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

          <section class="col-lg-12 connectedSortable">
             <!-- solid sales graph -->
             <div class="card">
              <div class="card-header row">
                <div class="col my-auto">
                  <h3 class="card-title my-auto">
                    <i class="fas fa-chart-line mr-1"></i>
                    Arus dan Tegangan 
                  </h3>
                </div>
                <div class="col-sm-6 my-auto text-right">
                  <div class="btn-group my-auto" role="group" aria-label="Time Interval Buttons">
                    <button type="button" class="btn btn-primary">15 Menit</button>
                    <button type="button" class="btn btn-primary">1 Jam</button>
                    <button type="button" class="btn btn-primary">4 Jam</button>
                    <button type="button" class="btn btn-primary">1 Hari</button>
                    <button type="button" class="btn btn-primary">1 Bulan</button>
                  </div>
                </div>  
              </div>
              <div class="card-body">
                <div class="chart" id="arus-tegangan-chart" style="position: relative; height: 300px;">
                    <canvas id="arus-tegangan-chart-canvas" height="300" style="height: 300px;"></canvas>
                  </div>
              </div>
            </div>
            <!-- /.card -->
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
// Function to fetch data from PHP script
function fetchDataLdr() {
  $.ajax({
    url: 'fetch_data_ldr.php',
    type: 'GET',
    dataType: 'json',
    success: function(data) {
      $('#ldr_lt').text(data.lt);
      $('#ldr_rt').text(data.rt);
      $('#ldr_ld').text(data.ld);
      $('#ldr_rd').text(data.rd);
      $('#create_at').text(data.create_at);
      updateServoPositions(data.lt, data.rt, data.ld, data.rd);
    },
    error: function(xhr, status, error) {
      console.error('Error fetching data:', error);
    }
  });
}


function updateServoPositions(lt, rt, ld, rd) {
  $.ajax({
    url: 'servo_control.php',
    type: 'POST',
    data: {
      lt: lt,
      rt: rt,
      ld: ld,
      rd: rd
    },
    dataType: 'json',
    success: function(data) {
      $('#servo_h').text(data.servo_h);
      $('#servo_v').text(data.servo_v);
      $('#direction').css('transform', `translateX(-50%) rotate(${data.servo_h}deg)`);
    },
    error: function(xhr, status, error) {
      console.error('Error updating servo positions:', error);
    }
  });
}

// Fetch data initially
fetchDataLdr();


// Fetch data every 5 seconds
setInterval(fetchDataLdr, 5000);
</script>


<script>
$(function () {
  'use strict'
  // chart
  var dualAxisSolarTrackerCanvas = document.getElementById('dual-axis-solar-tracker-chart-canvas').getContext('2d')

  var dualAxisSolarTrackerData = {
    labels: [],
    datasets: [
      {
        label: 'LT',
        backgroundColor: 'rgba(60,141,188,0.3)',
        borderColor: 'rgba(60,141,188,1)',
        pointRadius: 5,
        pointHoverRadius: 8,
        data: []
      },
      {
        label: 'RT',
        backgroundColor: 'rgba(40,167,69,0.3)',
        borderColor: 'rgba(36,150,62,1)',
        pointRadius: 5,
        pointHoverRadius: 8,
        data: []
      },
      {
        label: 'LD',
        
        backgroundColor: 'rgba(255,193,7,0.3)',
        borderColor: 'rgba(229,173,6,1)',
        pointRadius: 5,
        pointHoverRadius: 8,
        data: []
      },
      {
        label: 'RD',
        backgroundColor: 'rgba(220,53,69,0.3)',
        borderColor: 'rgba(220,53,69,1)',   
        pointRadius: 5,
        pointHoverRadius: 8,
        data: []
      },
      {
          label: 'LT Regression',
          backgroundColor: 'rgba(132,99,255,0.2)',
          borderColor: 'rgba(132,99,255,1)',  
          pointRadius: 0,
          pointHoverRadius: 0,
          data: [],
          borderDash: [5, 5],
          fill: false
      },
      {
          label: 'RT Regression',
          backgroundColor: 'rgba(99,255,132,0.2)',
          borderColor: 'rgba(99,255,132,1)',
          pointRadius: 0,
          pointHoverRadius: 0,
          data: [],
          borderDash: [5, 5],
          fill: false
      },
      {
          label: 'LD Regression',
          backgroundColor: 'rgba(255,132,99,0.2)',
          borderColor: 'rgba(255,132,99,1)',
          pointRadius: 0,
          pointHoverRadius: 0,
          data: [],
          borderDash: [5, 5],
          fill: false
      },
      {
          label: 'RD Regression',
          backgroundColor: 'rgba(255,99,132,0.2)',
          borderColor: 'rgba(255,99,132,1)',
          pointRadius: 0,
          pointHoverRadius: 0,
          data: [],
          borderDash: [5, 5],
          fill: false
      }
    ]
  }

  var dualAxisSolarTrackerOptions = {
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

  var dualAxisSolarTracker = new Chart(dualAxisSolarTrackerCanvas, {
    type: 'line',
    data: dualAxisSolarTrackerData,
    options: dualAxisSolarTrackerOptions
  })

  // Function to fetch data from PHP script
  function fetchDataArraydualAxisSolarTracker() {
    $.ajax({
      url: 'fetch_data_array_dual_axis_solar_tracker.php',
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        dualAxisSolarTrackerData.labels = data.label_dual_axis_solar_tracker_array;
        dualAxisSolarTrackerData.datasets[0].data = data.lt_array;
        dualAxisSolarTrackerData.datasets[1].data = data.rt_array;
        dualAxisSolarTrackerData.datasets[2].data = data.ld_array;
        dualAxisSolarTrackerData.datasets[3].data = data.rd_array;
        // Update regression data
        dualAxisSolarTrackerData.datasets[4].data = data.lt_regression;
        dualAxisSolarTrackerData.datasets[5].data = data.rt_regression;
        dualAxisSolarTrackerData.datasets[6].data = data.ld_regression;
        dualAxisSolarTrackerData.datasets[7].data = data.rd_regression;
        dualAxisSolarTracker.update()
      },
      error: function(xhr, status, error) {
        console.error('Error fetching data:', error);
      }
    });
  }

  // Fetch data initially
  fetchDataArraydualAxisSolarTracker();

  // Fetch data every 5 seconds
  setInterval(fetchDataArraydualAxisSolarTracker, 5000);

  // ---------------------------------------------
  // chart
  var suhuKelembabanCanvas = document.getElementById('suhu-kelembaban-chart-canvas').getContext('2d')

  var suhuKelembabanData = {
    labels: [],
    datasets: [
      {
        label: 'Suhu',
        backgroundColor: 'rgba(60,141,188,0.3)',
        borderColor: 'rgba(60,141,188,1)',
        pointRadius: 5,
        pointHoverRadius: 8,
        data: []
      },
      {
        label: 'Kelembaban',
        backgroundColor: 'rgba(40,167,69,0.3)',
        borderColor: 'rgba(36,150,62,1)',
        pointRadius: 5,
        pointHoverRadius: 8,
        data: []
      },
      {
          label: 'Suhu Regression',
          backgroundColor: 'rgba(132,99,255,0.2)',
          borderColor: 'rgba(132,99,255,1)',  
          pointRadius: 0,
          pointHoverRadius: 0,
          data: [],
          borderDash: [5, 5],
          fill: false
      },
      {
          label: 'Kelembaban Regression',
          backgroundColor: 'rgba(99,255,132,0.2)',
          borderColor: 'rgba(99,255,132,1)',
          pointRadius: 0,
          pointHoverRadius: 0,
          data: [],
          borderDash: [5, 5],
          fill: false
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

  var suhuKelembaban = new Chart(suhuKelembabanCanvas, { 
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
        suhuKelembabanData.datasets[2].data = data.temperature_regression;
        suhuKelembabanData.datasets[3].data = data.humidity_regression;
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
        backgroundColor: 'rgba(255,193,7,0.3)',
        borderColor: 'rgba(229,173,6,1)',
        pointRadius: 5,
        pointHoverRadius: 8,
        data: []
      },
      {
        label: 'Tegangan',
        backgroundColor: 'rgba(220,53,69,0.3)',
        borderColor: 'rgba(220,53,69,1)',
        pointRadius: 5,
        pointHoverRadius: 8,
        data: []
      },
      {
          label: 'Arus Regression',
          backgroundColor: 'rgba(255,132,99,0.2)',
          borderColor: 'rgba(255,132,99,1)',
          pointRadius: 0,
          pointHoverRadius: 0,
          data: [],
          borderDash: [5, 5],
          fill: false
      },
      {
          label: 'Tegangan Regression',
          backgroundColor: 'rgba(255,99,132,0.2)',
          borderColor: 'rgba(255,99,132,1)',
          pointRadius: 0,
          pointHoverRadius: 0,
          data: [],
          borderDash: [5, 5],
          fill: false
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

  var arusTegangan = new Chart(arusTeganganCanvas, { 
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
        arusTeganganData.datasets[2].data = data.arus_regression;
        arusTeganganData.datasets[3].data = data.tegangan_regression;
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
