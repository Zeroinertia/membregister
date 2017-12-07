<?php
	require_once('connection.php');
	$page='billing';
	include_once('include\header.php');

	if (isset($_GET['y']))
	{
		$year = ($_GET['y']);
		$_SESSION['superyear'] = $year;
	}
	else {
		$year = $_SESSION['superyear'];
	}
	$dueDates = array("20.11." . ($year - 1), "20.01." . $year, "20.03." . $year, "20.05." . $year);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
		<script src="../datatables/Datatables-1.10.16/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../datatables/DataTables-1.10.16/css/jquery.dataTables.min.css">

		<script>
			var year = <?=$year?>;
			function refupdate(year) {
				if(window.XMLHttpRequest) {
					xmlhttp = new XMLHttpRequest();
				} else {
					xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
				}

				xmlhttp.open('GET','calculateReferenceNumber.php?y=' + year,true);
				xmlhttp.send();
			}
			refupdate(year);
		</script>

		<script>
			var billingData;

			function getData()
			{
				$.ajax({
					type: 'GET',
					url: '../script/getTAs.php',
					dataType: 'json',
					success: function(data) { billingData = data; console.log(billingData); }
				});
			}
		</script>
		<style>
		th {
			padding: 5px;
			text-align: center;
		}
		.leftie {
			text-align: left;
		}
		tr {
			display: grid;
			grid-template-columns: 3fr 6fr repeat(4, 6fr 4fr);
		}
		</style>
		<script type="text/javascript">
      $(document).ready(function() {
        $('#billingtable').DataTable( {
					"ajax": {
						"url": "../script/getTAs.php",
						"dataSrc": ""
					},
          paging: true,
          info: true,
					"columns": [
						{"data": "id"},
						{"data": "name"},
						{"data": "ref1"},
						{"data": "paid1"},
						{"data": "ref2"},
						{"data": "paid2"},
						{"data": "ref3"},
						{"data": "paid3"},
						{"data": "ref4"},
						{"data": "paid4"}
					],
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
          }
        });
      });

			//window.onload = getData();
    </script>
	</head>
	<body style="max-width: 1500px; padding: 1px;">
    <h2>Laskut</h2>

    <table id="billingtable" class="display" style="width: 99%; margin: auto; text-align: center;">
			<thead style="display: grid;">
        <tr>
					<th class='leftie'>Jäsen-</br>numero</th>
					<th class='leftie'></br>Nimi</th>
					<th>Erä 1</br>Viitenumero</th>
					<th><?=$dueDates[0]?></br>Summa</th>
					<th>Erä 2</br>Viitenumero</th>
					<th><?=$dueDates[1]?></br>Summa</th>
					<th>Erä 3</br>Viitenumero</th>
					<th><?=$dueDates[2]?></br>Summa</th>
					<th>Erä 4</br>Viitenumero</th>
					<th><?=$dueDates[3]?></br>Summa</th>
				</tr>
      </thead>
			<tbody id="billingbody" style="display: grid;">
			</tbody>
    </table>
		<?php
		  include('include\footer.php');
		?>
	</body>
</html>
