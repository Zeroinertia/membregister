<?php
    require "connection.php";
    session_start();
    include('include\header.php');
    include('include\footer.php');
?>
<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../datatables/Datatables-1.10.16/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../datatables/DataTables-1.10.16/css/jquery.dataTables.min.css">

    <script type="text/javascript">
      $(document).ready(function() {
        $('#derptable').DataTable( {
          paging: false,
          info: false,
          "language" : {
            "sSearch" : "Etsi:",
            /*paginate : {
              "sLengthMenu" : "Näytä __MENU__ tulosta",
              "sPrevious" : "Edellinen",
              "sNext" : "Seuraava"
            }*/
          }
        });
      });
    </script>
  </head>
  <body>
    <a href="#" onClick="MyWindow=window.open('http://www.google.com','MyWin‌​dow','width=600,heig‌​ht=300'); return false;">Click Here</a>
    <table id="derptable" class="display">
      <thead style="display: grid">
        <tr style="display: grid; grid-template-columns: 1fr 2fr 2fr 1fr">
          <th>Jäsennumero</th>
          <th>Sukunimi</th>
          <th>Etunimi</th>
          <th>Aktiivinen</th>
        </tr>
      </thead>
      <tbody style="display: grid">
        <?php
          $query = "CALL getAllMembers";
          $result = mysqli_query($connection, $query) or die("Query failed: " . mysqli_error());

          while ($row = mysqli_fetch_row($result))
          {
            $active = "Yes";
            if ($row[3] == 0)
              $active = "No";

            echo "<tr style='display: grid; grid-template-columns: 1fr 2fr 2fr 1fr'>";
            echo "<td>";
            if ($row[0] < 10)
              echo ("00" . $row[0]);
            else if ($row[0] < 100)
              echo ("0" . $row[0]);
            else
              echo $row[0];
            echo ("</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $active . "</td>");
            echo "</tr>";
          }

        ?>
      </tbody>
    </table>
  </body>
</html>
