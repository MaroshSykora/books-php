<?php
// ADD STRANKA
require_once('Books.php');
include('DbConnect.php');

$conn = new DbConnect();
$dbConnection = $conn->connect();
$instanceBooks = new Books($dbConnection);
$books = $instanceBooks->getBooks();
// $selBooks = $books;

if (isset($_GET['isbn']) || isset($_GET['author_name']) || isset($_GET['author_surname'])) {
  $sel_isbn = $_GET['isbn'];
  $sel_author_name = $_GET['author_name'];
  $sel_author_surname = $_GET['author_surname'];
  $selBooks = $instanceBooks->filterBooks($sel_isbn, $sel_author_name, $sel_author_surname);
} else {
  $selBooks = $books;
}

// Zpracování mazání auta
if (isset($_GET['delete'])) {
  $bookIsbn = $_GET['delete'];
  $instanceBooks->deleteBook($bookIsbn);
  header("Location: index.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="wisbnth=device-wisbnth, initial-scale=1.0">
  <link href="./scss/custom.css" rel="stylesheet">
  <title>Prehled knih</title>
  <style>
    /* body * {
      border: solisbn 2px blue;
    } */
  </style>
</head>

<body>
  <!-- navbar zacatek -->
  <section>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluisbn">
        <a class="navbar-brand" href="index.php">Books</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" isbn="navbarSupportedContent">
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
  <section>
    <?php
    if (sizeOf($selBooks) > 0) {

    ?>
      <table class="table">
        <tr>
          <th>ISBN</th>
          <th>Name</th>
          <th>Surname</th>
          <th>Book name</th>
          <th>Info</th>
        </tr>
        <?php foreach ($selBooks as $book): ?>
          <tr>
            <td><?php echo $book['isbn']; ?></td>
            <td><?php echo $book['author_name']; ?></td>
            <td><?php echo $book['author_surname']; ?></td>
            <td><?php echo $book['book_name']; ?></td>
            <td><?php echo $book['info']; ?>
            <td>
              <!-- <a class="btn btn-warning" href="edit.php?isbn=<?php echo $book['isbn']; ?>">Editovat</a> -->
              <a class="btn btn-warning" href="index.php?delete=<?php echo $book['isbn']; ?>" onclick="return confirm('Opravdu chcete smazat toto auto?');">Smazat</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>

    <?php
    } else { ?>
      <p>Žádná auta k zobrazení</p>
    <?php
    }
    ?>
  </section>
  <!-- main konec -->


  <!-- SKRIPT BOOTSTRAP -->
  <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- ^^^^^ -->
</body>

</html>