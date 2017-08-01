<?php
	require "connection.php";
	session_start();
?>

<?php

		$sql = "CALL getRefdata('$year')";
		$array = array();

		if (mysqli_multi_query($connection, $sql))
		{
		  do {
		    if ($result = mysqli_store_result($connection))
		    {
		      $i = 0;
		      while ($row = mysqli_fetch_row($result))
		      {
		        $array[$i] = array();
		        $array[$i]['ta_id'] = $row[0];
		        $array[$i]['m_id'] = $row[1];
		        $array[$i]['ref1'] = $row[2];
		        $array[$i]['ref2'] = $row[3];
		        $array[$i]['ref3'] = $row[4];
		        $array[$i]['ref4'] = $row[5];
		        $i++;
		      }
		      unset($i);
		    }
		  } while (mysqli_next_result($connection));
		}

		unset($query);
		mysqli_free_result($result);

		foreach ($array as &$value)
		{
			$memID = (string) $value[1];
			if ($value[1] < 100 && $value[1] > 9)
				$memID = "0" . $memID;
			else if ($value[1] < 10)
				$memID = "00" . $memID;

			$year = (string) $year;
			if (strlen($value[2]) == 1)
			{
				$value[2] = $year . $memID . $value[2];
				$value[2] = $value[2] . calculateVerificationDigit($value[2]);
			}

			if (strlen($value[3]) == 1)
			{
				$value[3] = $year . $memID . $value[3];
				$value[3] = $value[3] . calculateVerificationDigit($value[3]);
			}

			if (strlen($value[4]) == 1)
			{
				$value[4] = $year . $memID . $value[4];
				$value[4] = $value[4] . calculateVerificationDigit($value[4]);
			}

			if (strlen($value[5]) == 1)
			{
				$value[5] = $year . $memID . $value[5];
				$value[5] = $value[5] . calculateVerificationDigit($value[5]);
			}


			$updatesql = "CALL updateRefNumbers('$row[0]', '$value[2]', '$value[3]', '$value[4]', '$value[5]')";
			$updateresult = mysqli_query($connection, $updatesql) or die("Query fail: " . mysqli_error());
		}

	// Function to calculate the verification digit at the end of the reference number.
	function calculateVerificationDigit($refNumber)
	{
		$verificationDigit = 0;
		for ($i = 0; $i < 8; $i++)
		{
			$digitToAdd = (int) $refNumber[$i];
			if ($i % 3 == 0)
				$digitToAdd *= 7;
			else if ($i % 3 == 1)
				$digitToAdd *= 3;

			$verificationDigit += $digitToAdd;
		}

		$verificationDigit %= 10;

		return (string) $verificationDigit;
	}
?>
