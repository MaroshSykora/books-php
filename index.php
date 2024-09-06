<?php
// UVODNI STRANKA

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./scss/custom.css" rel="stylesheet">
  <title>Prehled knih</title>
  <!-- <style>
    body * {
      border: solid 2px blue;
    }
  </style> -->
</head>

<body>
  <!-- navbar zacatek -->
  <section>
    <nav class="navbar navbar-expand-lg black-bg">
      <div class="container-fluid">
        <a class="navbar-brand green-color fs-3" href="index.php">Books</a>
        <button class="navbar-toggler light-bg" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 fs-4">
            <li class="nav-item">
              <a class="nav-link active text-white" href="add.php">Add</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="list.php">List</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="search.php">Search</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </section>
  <!-- navbar konec -->

  <!-- main zacatek -->
  <section class="main container align-items-center justify-content-center text-center d-flex">
    <div class="row ">
      <div class="col-12 d-flex flex-column align-items-center">
        <span class="fs-2">Welcome to:</span>
        <span class="adjustable-size">BOOKS</span>
      </div>
    </div>
  </section>
  <!-- main konec -->


  <!-- SKRIPT BOOTSTRAP -->
  <script src="./bootstrap.bundle.min.js"></script>
  <!-- ^^^^^ -->
</body>

</html>