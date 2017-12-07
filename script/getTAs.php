<?php
  require_once('../php/connection.php');
  session_start();
?>

<?php
  $year = $_SESSION['superyear'];

  $query = "call getTAData($year)";
  $array = array();

  if (mysqli_multi_query($connection, $query))
  {
    $result = mysqli_store_result($connection);
    do
    {
      $i = 0;
      while ($row = mysqli_fetch_row($result))
      {
        $leading = "";
        if ($row[0] < 10)
          $leading = "00";
        else if ($row[0] < 100)
          $leading = "0";

        $array[$i] = array();
        $array[$i]['id'] = $leading . $row[0];
        $array[$i]['ref1'] = "<button class='btn' value='$row[1]'>$row[1]</button>";
        $array[$i]['paid1'] = $row[2];
        $array[$i]['ref2'] = "<button class='btn'  value='$row[3]'>$row[3]</button>";
        $array[$i]['paid2'] = $row[4];
        $array[$i]['ref3'] = "<button class='btn' value='$row[5]'>$row[5]</button>";
        $array[$i]['paid3'] = $row[6];
        $array[$i]['ref4'] = "<button class='btn' value='$row[7]'>$row[7]</button>";
        $array[$i]['paid4'] = $row[8];
        $i++;
      }
    } while (mysqli_next_result($connection));
  }

  mysqli_free_result($result);

  unset($query);
  unset($result);

  $returnArray = array();
  $nthRow = 0;

  foreach ($array as &$value)
  {
    $id = $value['id'];
    $result2 = getNames($connection, $id);

    $array[$nthRow]['name'] = $result2;
    $nthRow++;
  }

  echo json_encode($array);

  function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
  }

  function getNames($con, $num)
  {
    $namequery = "call getNames($num)";
    $returnval = $num;

    if (mysqli_multi_query($con, $namequery))
    {
      $res = mysqli_store_result($con);
      do {
        while ($rw = mysqli_fetch_row($res))
        {
          $returnval = $rw[0] . " " . $rw[1];
        }
      } while (mysqli_next_result($con));
    }
    mysqli_free_result($res);

    unset($namequery);
    unset($res);

    return ($returnval);
  }

  function free_result() {
        while (mysqli_more_results($this->connection) && mysqli_next_result($this->connection)) {

            $dummyResult = mysqli_use_result($this->connection);

            if ($dummyResult instanceof mysqli_result) {
                mysqli_free_result($this->connection);
            }
        }
    }
?>
