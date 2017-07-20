<?php
require_once('connection.php');
session_start();
$page='laskut';
include('include\header.php');
 ?>



      <div class="col-md-12">
        <h2>Laskut</h2>

            <table class="table table-striped">
                <thead>

            <tr>
              <th>Jäsenumero</th>
              <th>Sukunimi  Etunimi</th>
              <th><br>Erä1</br>Viite</th>
              <th><br>PVM</br>Summa</th>
              <th><br>Erä2</br>Viite</th>
              <th><br>PVM</br>Summa</th>
              <th><br>Erä3</br>Viite</th>
              <th><br>PVM</br>Summa</th>
              <th><br>Erä4</br>Viite</th>
              <th><br>PVM</br>Summa</th>
            </tr>


                    <?php
                      $query="call getTAData ('$year')";
                      $result1=mysqli_query($connection, $query) or die("Query fail: " .  mysqli_error($connection));

                      while ($row = mysqli_fetch_row($result1)){

                        $query2="call getNames('$row[0]')";
                        $result2=mysqli_query($connection,$query2) or die("Query fail: " . mysqli_error($connection));

                        if ($line = mysqli_fetch_row($result2))
                        {
                        echo "<tr>";
                        echo ("<th>" . $row[0] . "</th><th>" . $line[0] . " " . $line[1] . "</th>" .
                        "<th>" . $row[1] . "</th><th>" . $row[2] . "</th>" .
                        "<th>" . $row[3] . "</th><th>" . $row[4] . "</th>" .
                        "<th>" . $row[5] . "</th><th>" . $row[6] . "</th>" .
                        "<th>" . $row[7] . "</th><th>" . $row[8] . "</th>");
                        echo "</tr>";
                      }
                      }

                   ?>


  </thead>
<tbody>

    <tr>
          <td></td>
          <td></td>
          <td> <button type="button" class="btn btn-default">Label</button></td>
          <td></td>
          <td><button type="button" class="btn btn-default">Label</button> </td>
          <td></td>
          <td><button type="button" class="btn btn-default">Label</button></td>
          <td></td>
          <td><button type="button" class="btn btn-default">Label</button></td>
      </tr>
              </tbody>
          </table>
      </div>


<?php
include('include\footer.php');
 ?>
