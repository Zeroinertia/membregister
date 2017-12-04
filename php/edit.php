<?php
require ('connection.php');
session_start();
$page='edit';
include('include\header.php');
$id = $_GET['id'];
?>
<head>
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<?php
  $query = "CALL getEditDefaults('$id')";
  $result = mysqli_query($connection, $query) or die("Query failed: " . mysqli_error($connection));

  $data = mysqli_fetch_row($result);

  for ($i = 0; $i < 5; $i++)
  {
    if ($data[$i] == null)
      $data[$i] = "Lisää uusi";
  }

  $lname = $data[0];
  $fname = $data[1];
  $email = $data[2];
  $address = $data[3];
  $phone = $data[4];
?>

</head>

<body>
<div class="col-md-12">
  <h2>Muokkaa</h2>

  <div class="container">
    <form class="form-inline" action="edit.php">
        <div class="form-group">
          <label for="lastname">Sukunimi:</label><br>
          <input type="text" class="form-control" id="lastname" placeholder="<?=$lname?>" name="sukunimi">
          </div>

      <div class="form-group">
        <label for="firstname">Etunimi:</label><br>
        <input type="text" class="form-control" id="firstname" placeholder="<?=$fname?>" name="firstname">
      </div>



      <div style="margin-top:40px"></div>

      <div class="container_2">
        <form class="form-inline" action="edit.php">
        <div class="form-group">
        <label for="email">Sähköposti:</label><br>
          <input type="email" class="form-control" id="email" placeholder="<?=$email?>">
        </div>

          <div class="form-group">
            <label for="address">Osoite</label><br>
      <input type="text" class="form-control" id="address" placeholder="<?=$address?>">
          </div>
        </div>

          <div style="margin-top:40px"></div>

          <div class="container_3">
            <form class="form-inline" action="edit.php">
            <div class="form-group">
            <label for="phone">Puhelinnumero:</label><br>
              <input type="tel" class="form-control" id="phonenumber" placeholder="<?=$phone?>">
                </div>

              <div class="form-group">
                <label for="address">Aktiivinen</label><br>
            <input type="checkbox" checked data-toggle="toggle" data-on="Kyllä" data-off="Ei" data-onstyle="success" data-offstyle="danger" id="activity">

            </div>
          </div>


  </body>
