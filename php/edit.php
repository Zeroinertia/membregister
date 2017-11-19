<?php
require ('connection.php');
session_start();
$page='edit';
include('include\header.php');
?>

<div class="col-md-12">
  <h2>Muokkaa</h2>

<body>

  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

  <div class="container">
    <form class="form-inline" action="edit.php">
        <div class="form-group">
          <label for="lastname">Sukunimi:</label><br>
          <input type="text" class="form-control" id="lastname" placeholder="Uusi sukunimi" name="sukunimi">
          </div>

      <div class="form-group">
        <label for="firstname">Etunimi:</label><br>
        <input type="text" class="form-control" id="firstname" placeholder="Uusi etunimi" name="firstname">
      </div>



      <div style="margin-top:40px"></div>

      <div class="container_2">
        <form class="form-inline" action="edit.php">
        <div class="form-group">
        <label for="email">Sähköposti:</label><br>
          <input type="email" class="form-control" id="email" placeholder="Uusi sähköposti">
        </div>

          <div class="form-group">
            <label for="address">Osoite</label><br>
      <input type="text" class="form-control" id="address" placeholder="Uusi osoite">
          </div>
        </div>

          <div style="margin-top:40px"></div>

          <div class="container_3">
            <form class="form-inline" action="edit.php">
            <div class="form-group">
            <label for="phone">Puhelinnumero:</label><br>
              <input type="tel" class="form-control" id="phonenumber" placeholder="Uusi Puhelinnumero">
                </div>

              <div class="form-group">
                <label for="address">Aktiivinen</label><br>
            <input type="checkbox" checked data-toggle="toggle" data-on="Kyllä" data-off="Ei" data-onstyle="success" data-offstyle="danger" id="activity">

            </div>
          </div>






  </body>
