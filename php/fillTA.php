<?php
  require_once('connection.php');
?>

<?php
  for ($i = 5; $i < 57; $i++)
  {
    $query = "call newTransactionRow('$i', '2017')";

    if (mysqli_multi_query($connection, $query))
    {
      $result = mysqli_store_result($connection);
      do {
        // naught to do
      } while (mysqli_next_result($connection));
    }
  }
?>
