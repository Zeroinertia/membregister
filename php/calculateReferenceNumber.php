<?php
	require "connection.php";
	session_start();
?>

<?php
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

		return ($refNumber . (string) $verificationDigit);
	}

	function calculateReferenceNumbers($connection, $year)
	{
		$sql = "CALL getRefdata('$year')";
		$result = mysqli_query($connection, $sql) or die("Query fail: " . mysqli_error());


		while ($row = mysqli_fetch_array($result))
		{
			if (strlen($row[2]) > 1 || strlen($row[3]) > 1 || strlen($row[4]) > 1 || strlen($row[5]) > 1)
				continue;

			$memID = (string) $row[1];
			$ref1 = $row[2];
			$ref2 = $row[3];
			$ref3 = $row[4];
			$ref4 = $row[5];

			if ($row[1] < 100 && $row[1] > 9)
				$memID = "0" . $memID;
			else if ($row[1] < 10)
				$memID = "00" . $memID;

			$year = (string) $year;
			$ref1 = $year . $memID . $ref1;
			$ref1 = calculateVerificationDigit($ref1);
			$ref2 = $year . $memID . $ref2;
			$ref2 = calculateVerificationDigit($ref2);
			$ref3 = $year . $memID . $ref3;
			$ref3 = calculateVerificationDigit($ref3);
			$ref4 = $year . $memID . $ref4;
			$ref4 = calculateVerificationDigit($ref4);

			$updatesql = "CALL updateRefNumbers('$row[0]', '$ref1', '$ref2', '$ref3', '$ref4')";
			$updateresult = mysqli_query($connection, $updatesql) or die("Query fail: " . mysqli_error());
		}
	}
?>
