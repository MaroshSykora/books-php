<?php
// add.php
// ADD STRANKA
require_once('Books.php');
include('DbConnect.php');

// Vytvoření instance třídy DbConnect a získání připojení
$conn = new DbConnect();
$dbConnection = $conn->connect();

// Vytvoření instance třídy Books
$instanceBooks = new Books($dbConnection);

// Hlídá, jestli je v globálním poli klíč 'add' a pokud ano, zavolá se metoda addBook
if (isset($_POST['add'])) {
  $isbn = $_POST['isbn'];
  $author_name = $_POST['author_name'];
  $author_surname = $_POST['author_surname'];
  $book_name = $_POST['book_name'];
  $info = $_POST['info'];
  $instanceBooks->addBook($isbn, $author_name, $author_surname, $book_name, $info);
  header("Location: list.php");
  exit();
}
// Přejde na seznam knih (nebo jinou cílovou stránku)
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./scss/custom.css" rel="stylesheet">
  <title>Prehled knih</title>
  <style>
    /* body * {
      border: solid 2px blue;
    } */
  </style>
</head>

<body>
  <!-- navbar zacatek -->
  <section>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Books</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" href="add.php">Add</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="list.php">List</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="search.php">Search</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </section>
  <!-- navbar konec -->

  <!-- main zacatek -->
  <section class="container">
    <form action="add.php" method="post" class="row g-3 my-5">
      <div class="col-md-12">
        <input type="number" class="form-control" name="isbn" placeholder="ISBN" value="" required>
      </div>
      <div class="col-md-12">
        <input type="text" class="form-control" name="author_name" value="" placeholder="Author's Name" required>
      </div>
      <div class="col-md-12">
        <input type="text" class="form-control" name="author_surname" value="" placeholder="Author's Surname" required>
      </div>
      <div class="col-md-12">
        <input type="text" class="form-control" name="book_name" placeholder="Book Name" value="" required>
      </div>
      <div class="col-md-12">
        <textarea class="form-control" name="info" placeholder="Info" required rows="4" cols="50"></textarea>
      </div>
      <div class="col-12">
        <input class="btn btn-primary" type="submit" name="add" value="Add a book">
      </div>
    </form>
  </section>
  <!-- main konec -->


  <!-- SKRIPT BOOTSTRAP -->
  <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- ^^^^^ -->
</body>

</html>