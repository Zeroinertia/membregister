<?php
require ('connection.php');
session_start();
$page='laskut';
include('include\header.php');
 ?>

<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 6ae26ba3ea96fb533445e8940061b0834037751c
<script>
function refupdate() {
	if(window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}

	xmlhttp.open("GET","calculateReferenceNumber.php",true);
	xmlhttp.send();
}
</script>
<<<<<<< HEAD
=======
=======

<style media="screen">
.active{
    background:#357EBD;
    color:#orange;
}
</style>
>>>>>>> ff0a0b461373a2efd31030ecdf9bb4242818da0e
>>>>>>> 6ae26ba3ea96fb533445e8940061b0834037751c
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


<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 6ae26ba3ea96fb533445e8940061b0834037751c
                   <?php

                   $query = "call getTAData('$year')";
                   $array = array();

                   if (mysqli_multi_query($connection, $query))
                   {
                     do {
                       if ($result = mysqli_store_result($connection))
                       {
                         $i = 0;
                         while ($row = mysqli_fetch_row($result))
                         {
                           $array[$i] = array();
                           $array[$i]['id'] = $row[0];
                           $array[$i]['ref1'] = $row[1];
                           $array[$i]['paid1'] = $row[2];
                           $array[$i]['ref2'] = $row[3];
                           $array[$i]['paid2'] = $row[4];
                           $array[$i]['ref3'] = $row[5];
                           $array[$i]['paid3'] = $row[6];
                           $array[$i]['ref4'] = $row[7];
                           $array[$i]['paid4'] = $row[8];
                           $i++;
                         }
                         unset($i);
                       }
                     } while (mysqli_next_result($connection));
                   }

                   unset($query);


                   foreach ($array as &$value)
                   {
                     $id = $value['id'];
                     $result2 = getNames($connection, $id);

                     echo "<tr>";
                     echo ("<th>" . $value['id'] . "</th><th>" . $result2 . "</th>" .
                     "<th>" . $value['ref1'] . "</th><th>" . $value['paid1'] . "</th>" .
                     "<th>" . $value['ref2'] . "</th><th>" . $value['paid2'] . "</th>" .
                     "<th>" . $value['ref3'] . "</th><th>" . $value['paid3'] . "</th>" .
                     "<th>" . $value['ref4'] . "</th><th>" . $value['paid4'] . "</th>");
                     echo "</tr>";

                   }


                   function getNames($con, $num)
                   {
                     $namequery = "call getNames('$num')";

                     if (mysqli_multi_query($con, $namequery))
                     {
                       do {
                         if ($result = mysqli_store_result($con))
                         {
                           while ($tempres = mysqli_fetch_row($result))
                           {
                             $returnval = $tempres[0] . " " . $tempres[1];
                           }
                         }
                       } while (mysqli_next_result($con));
                     }

                     unset($namequery);
                     unset($tempres);

                     return ($returnval);
                   }
<<<<<<< HEAD
=======
=======
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

>>>>>>> ff0a0b461373a2efd31030ecdf9bb4242818da0e
>>>>>>> 6ae26ba3ea96fb533445e8940061b0834037751c
                   ?>


  </thead>
<tbody>

    <tr>
          <td></td>
          <td></td>
<<<<<<< HEAD
          <td><button type="button" class="btn btn-default" onclick="refupdate();">Label</button></td>
=======
<<<<<<< HEAD
          <td><button type="button" class="btn btn-default" onclick="refupdate();">Label</button></td>
=======
          <td> <input type='button' onClick="jQuery(this).toggleClass('active')" value='click me'></td>
>>>>>>> ff0a0b461373a2efd31030ecdf9bb4242818da0e
>>>>>>> 6ae26ba3ea96fb533445e8940061b0834037751c
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
