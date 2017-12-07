<?php
  require_once('connection.php');
  session_start();
  $page='koti';
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
      $(document).ready(function() {
        $('#indextable').DataTable( {
          paging: false,
          info: false,
          "language" : {
            "sSearch" : "Etsi:",
						"lengthMenu": "Näytä _MENU_ tulosta sivulla",
						"zeroRecords": "Ei yhtään tulosta.",
						"info": "Näytetään sivu _PAGE_ / _PAGES_",
						"sInfo": "Näytetään _START_ - _END_ / _TOTAL_ riviä",
  					"sInfoEmpty": "Ei yhtään tulosta.",
  					"sInfoFiltered": "(suodatettu _MAX_ rivistä.)",
						"oPaginate": {
            "sFirst":    "Ensimmäinen",
            "sLast":    "Viimeinen",
            "sNext":    "Seuraava",
            "sPrevious": "Edellinen"
						}
        });
      });
    </script>
  </head>
  <body>
    <table id="indextable" class="display">
      <thead style="display: grid">
        <tr style="display: grid; grid-template-columns: 1fr 2fr 2fr 1fr">
          <th>Jäsennumero</th>
          <th>Sukunimi</th>
          <th>Etunimi</th>
          <th>Muokkaa</th>
        </tr>
      </thead>
      <tbody style="display: grid">
        <?php
          $query = "CALL getActiveMembers";
          $result = mysqli_query($connection, $query) or die("Query failed: " . mysqli_error($connection));

          while ($row = mysqli_fetch_row($result))
          {
            //$active = "Yes";
            //if ($row[3] == 0)
            //  $active = "No";

            echo "<tr style='display: grid; grid-template-columns: 1fr 2fr 2fr 1fr'>";
            echo "<td>";
            if ($row[0] < 10)
              echo ("00" . $row[0]);
            else if ($row[0] < 100)
              echo ("0" . $row[0]);
            else
              echo $row[0];
            echo ("</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . "<a href='edit.php?id=" . $row[0] . "'>Muokkaa</a>" . "</td>");
            echo "</tr>";
          }

        ?>
      </tbody>
    </table>
  </body>
</html>
