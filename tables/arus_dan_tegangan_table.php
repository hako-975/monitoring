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
  <title>Arus & Tegangan</title>
  <link rel="icon" href="https://png.pngtree.com/png-clipart/20200225/original/pngtree-computer-static-graph-monitor-abstract-flat-color-icon-templa-png-image_5254061.jpg">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link href="../plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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
            <h1>Arus dan Tegangan</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <div id="tableContainer"></div>
              </div>
            </div>
            <!-- /.card -->

            <!-- /.card -->
          </div>
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
<!-- AdminLTE for demo purposes -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap4.min.js"></script>

<script>
function updateRealTimeTable(data) {
    var tableContainer = $('#tableContainer');
    tableContainer.empty(); // Clear existing data
    
    var table = $('<table>').addClass('table table-bordered').attr('id', 'dataTable');
    var thead = $('<thead>').appendTo(table);
    var tbody = $('<tbody>').attr('id', 'dataBody').appendTo(table);

    // Add table header
    var headerRow = $('<tr>').appendTo(thead);
    headerRow.append($('<th>').text('No.'));
    headerRow.append($('<th>').text('Arus'));
    headerRow.append($('<th>').text('Tegangan'));
    headerRow.append($('<th>').text('Create At'));

    // Loop through the data and populate the table rows
    for (var i = 0; i < data.label_arus_tegangan_array.length; i++) {
        var row = $('<tr>');
        row.append($('<td>').text(i + 1 + ".")); // No.
        row.append($('<td>').text(data.arus_array[i])); // Arus
        row.append($('<td>').text(data.tegangan_array[i])); // Tegangan
        row.append($('<td>').text(data.label_arus_tegangan_array[i])); // Tegangan
        tbody.append(row); // Append row to table
    }

    // Append table to container
    tableContainer.append(table);
}

// Function to fetch real-time data from server
function fetchRealTimeData() {
    $.ajax({
        url: '../fetch_data_array_arus_tegangan_no_limit.php', // Path to server-side script
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            updateRealTimeTable(data); 
            $('#dataTable').DataTable({
              "destroy": true
            });
        },
        error: function(xhr, status, error) {
            console.error('Error fetching real-time data:', error);
        }
    });
}

// Fetch real-time data initially and then every 5 seconds
fetchRealTimeData();
setInterval(fetchRealTimeData, 5000); // Refresh data every 5 seconds
</script>
</body>
</html>
