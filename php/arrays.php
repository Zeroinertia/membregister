
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
mysqli_free_result($result);

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

  mysqli_free_result($result2);
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
  mysqli_free_result($result);
  return ($returnval);
}
?>
