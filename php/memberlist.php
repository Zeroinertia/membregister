<<<<<<< HEAD
<?php
    require "connection.php";
    session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
=======
<!DOCTYPE HTML>
<html lang="en">
  <head>
    <title>Jäsenlista</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
>>>>>>> d24d48174501c259ac7c732324c5f82eedcff30a
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
    integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<<<<<<< HEAD
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jäsenlista</title>
  </head>
  <body>

    <div class="container-fluid, display-table">
      <table class="table">
        <tbody>
          <?php
              $query = "CALL getActiveMembers";
              $result = mysqli_query($connection, $query) or die("Query failed: " . mysqli_error());

              while ($row = mysqli_fetch_row($result))
              {
                  $active = "Yes";
                  if($row[3] == 0)
                    $active = "No";

                  echo "<tr>";
                  echo ("<td>ID: " . $row[0] . "</td>
                    <td>Last name: " . $row[1] . " First name: " . $row[2] . "</td>
                    <td>Active: " . $active . "</td>");
                  echo "</tr><br>";
              }
          ?>
        </tbody>
      </table>
=======
  </head>
  <body>
    <div class="container-fluid, display-table">
      
>>>>>>> d24d48174501c259ac7c732324c5f82eedcff30a
    </div>

  </body>
</html>
