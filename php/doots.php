<?php
    require_once("connection.php");
    session_start();
    include_once('include\header.php');
    include_once('include\footer.php');
?>
<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
    <script src="../datatables/Datatables-1.10.16/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../datatables/DataTables-1.10.16/css/jquery.dataTables.min.css">

    <script type="text/javascript">

      var billingData;

      function getData()
      {
        $.ajax({
          type: 'GET',
          url: '../script/getTAs.php',
          dataType: 'json',
          success: function(data) { billingData = data; }
        });
      }

      $(document).ready(function() {
        $('#derptable').DataTable( {
          paging: false,
          info: false,
          "language" : {
            "sSearch" : "Etsi:",

          }
        });
      });
    </script>
  </head>
  <body>
    <thead>
      <tr>
        <th>Jäsennumero</th>
        <th>Nimi</th>
        <th>Viite1</th>
        <th>Maksettu1</th>
        <th>Viite2</th>
        <th>Maksettu2</th>
        <th>Viite3</th>
        <th>Maksettu3</th>
        <th>Viite4</th>
        <th>Maksettu4</th>
      </tr>
    </thead>
  </body>
</html>
