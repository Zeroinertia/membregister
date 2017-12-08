<?php
require_once('connection.php');
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
  $active = $data[5];

  $_SESSION['superid'] = $id;
?>

<script>
  function nameCheck()
  {
    var lastNameCheck = document.getElementById("lastname").value;
    var firstNameCheck = document.getElementById("firstname").value;
    var emailCheck = document.getElementById("email").value;
    var addressCheck = document.getElementById("address").value;
    var phoneCheck = document.getElementById("phonenumber").value;
    var activeCheck = document.getElementById("activity").checked;

    if (lastNameCheck == "")
    {
      if (!confirm("Sukunimi kenttä on tyhjä. Poistetaanko sukunimi?"))
        return 0;
    }
    else if (firstNameCheck == "")
    {
      if (!confirm("Etunimi kenttä on tyhjä. Poistetaanko sukunimi?"))
        return 0;
    }

    if (emailCheck == "")
    {
      if ("<?=$email?>" == "Lisää uusi")
        emailCheck = "";
      else
        emailCheck = "<?=$email?>";
    }
    if (addressCheck == "")
    {
      if ("<?=$address?>" == "Lisää uusi")
        addressCheck = "";
      else
        addressCheck = "<?=$address?>";
    }
    if (phoneCheck == "")
    {
      if ("<?=$phone?>" == "Lisää uusi")
        phoneCheck = "";
      else
        phoneCheck = "<?=$phone?>";
    }

    window.location = "updateInfo.php?newlname=" + lastNameCheck + "&newfname=" + firstNameCheck + "&newemail=" + emailCheck + "&newaddress=" + addressCheck + "&newphone=" + phoneCheck + "&active=" + activeCheck;
  }
</script>
</head>

<body>
<div class="col-md-12">
  <h2>Muokkaa</h2>

  <div class="container">
    <form class="form-inline" action="edit.php" style="max-width: 600px; width: 80%;">
        <div class="form-group">
          <label for="lastname">Sukunimi:</label><br>
          <input type="text" class="form-control" id="lastname" value="<?=$lname?>" name="sukunimi">
          </div>

      <div class="form-group">
        <label for="firstname">Etunimi:</label><br>
        <input type="text" class="form-control" id="firstname" value="<?=$fname?>" name="firstname">
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

              <?php
              if ($active == "0" || $active == 0)
                echo '<input type="checkbox" data-toggle="toggle" data-on="Kyllä" data-off="Ei" data-onstyle="success" data-offstyle="danger" id="activity" />';
              else {
                echo '<input type="checkbox" data-toggle="toggle" data-on="Kyllä" data-off="Ei" data-onstyle="success" data-offstyle="danger" id="activity" checked="checked" />';
              }
              ?>

            </div>
          </div>

        <button type="button" class="btn" id="editUpdateBtn" onclick="nameCheck()">Päivitä</button>
    </form>
  </div>
</div>
</body>
</html>
