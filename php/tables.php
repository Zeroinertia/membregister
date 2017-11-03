<?php
    require "connection.php";
    session_start();
?>
<html lang="en">
  <head>
    <title>Jäsenlista</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
    integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" src="../datatables/DataTables-1.10.16/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="../datatables/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/plug-ins/1.10.16/i18n/Finnish.json"></script>
    <script>
      $(document).ready(function() {
        $('#derptable').DataTable( {
          "language" : {
            search : "Etsi:"
          }
        } );
        oTable.$('tr:odd').css('backgroundColor', 'blue');
      } );
    </script>
  </head>
  <body>
    <table id="derptable" class="display" width="60%" cellspacing="5">
      <thead>
        <tr>
          <th>ID</th>
          <th>Last Name</th>
          <th>First Name</th>
          <th>Active</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $query = "CALL getActiveMembers";
          $result = mysqli_query($connection, $query) or die("Query failed: " . mysqli_error());

          while ($row = mysqli_fetch_row($result))
          {
            $active = "Yes";
            if ($row[3] == 0)
              $active = "No";

            echo "<tr>";
            echo ("<td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $active . "</td>");
            echo "</tr>";
          }

        ?>
      </tbody>
    </table>

  </body>
