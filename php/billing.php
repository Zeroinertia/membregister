<?php
	require ('connection.php');
	session_start();
	$page='billing';
	include('include\header.php');
	$year=2017;
	if (isset($_GET['year']))
	{
		$year = ($_GET['year']);
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
		<script src="../datatables/Datatables-1.10.16/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../datatables/DataTables-1.10.16/css/jquery.dataTables.min.css">

		<script type="text/javascript">
      $(document).ready(function() {
        $('#billingtable').DataTable( {
          paging: false,
          info: false,
          "language" : {
            "sSearch" : "Etsi:",
          }
        });
      });
    </script>

		<script>
			<?php
				if ($year!=0)
				{
					echo 'function refupdate() {
						if(window.XMLHttpRequest) {
							xmlhttp = new XMLHttpRequest();
						} else {
							xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
						}

						xmlhttp.open("GET","calculateReferenceNumber.php?y=' . $year . '",true);
						xmlhttp.send();
					}';
				}
			?>
		</script>
		<style>
		th { padding: 5px; }
		</style>

	</head>
	<body>
      <h2>Laskut</h2>

      <table id="billingtable" class="display">
				<thead style="display: grid">
	        <tr style="display: grid, grid-template-columns: 1fr 4fr 2fr 2fr 2fr 2fr 2fr 2fr 2fr 2fr">
						<th>Jäsennro.</th>
						<th>Nimi</th>
						<th>Erä 1</br>Viitenumero</th>
						<th>Eräpäivä</br>Summa</th>
						<th>Erä 2</br>Viitenumero</th>
						<th>Eräpäivä</br>Summa</th>
						<th>Erä 3</br>Viitenumero</th>
						<th>Eräpäivä</br>Summa</th>
						<th>Erä 4</br>Viitenumero</th>
						<th>Eräpäivä</br>Summa</th>
					</tr>
	      </thead>
				<tbody style="display: grid">
					<?php
          	$query = "call getTAData('$year')";
          	$array = array();

            if (mysqli_multi_query($connection, $query))
            {
              do
							{
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
              echo ("<td>" . $value['id'] . "</td><td>" . $result2 . "</td>" .
              "<td>" . $value['ref1'] . "</td><td>" . $value['paid1'] . "</td>" .
              "<td>" . $value['ref2'] . "</td><td>" . $value['paid2'] . "</td>" .
              "<td>" . $value['ref3'] . "</td><td>" . $value['paid3'] . "</td>" .
              "<td>" . $value['ref4'] . "</td><td>" . $value['paid4'] . "</td>");
              echo "</tr>";
            }

						function getNames($con, $num)
            {
              $namequery = "call getNames('$num')";

              if (mysqli_multi_query($con, $namequery))
              {
                do
								{
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
          ?>

				</tbody>
      </table>
		<?php
		  include('include\footer.php');
		?>
	</body>
</html>
