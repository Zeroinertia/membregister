<!DOCTYPE html>
<html lang="en" charset="utf-8m4">
    <head>
      <title>Jäsenrekisteri</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" href="../css/style.css">

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </head>

    <body>

      <nav class="navbar navbar-default">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">

              <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>

              </button>
              <a href="#" class="navbar-brand">Jäsenrekisteri</a>

          </div>

          <!-- Collection of nav links, forms, and other content for toggling -->

          <div id="navbarCollapse" class="collapse navbar-collapse">

              <ul class="nav navbar-nav">
                  <li class="<?php if ($page=='koti'){echo 'active';} ?>"><a href="index.php">Koti</a></li>
                  <li class="<?php if ($page=='billing'){echo 'active';} ?>"><a href="billing.php">Laskut</a></li>
                    <li class="<?php if ($page=='add'){echo 'active';} ?>"><a href="add.php">Lisää</a></li>
                      <li class="<?php if ($page=='edit'){echo 'active';} ?>"><a href="edit.php">Muokkaa</a></li>
              </ul>

              <ul class="nav navbar-nav navbar-right">
                  <li><a href="#">Login</a></li>
              </ul>
          </div>

      </nav>


      <div id="content">

      </div>
    </body>
</html>
