<?php
require_once('Books.php');
include('DbConnect.php');

$conn = new DbConnect();
$dbConnection = $conn->connect();
$instanceBooks = new Books($dbConnection);
$Books = $instanceBooks->getBooks();
// $selBooks = $Books;

if (isset($_GET['isbn']) || isset($_GET['author_name']) || isset($_GET['author_surname']) || isset($_GET['book_name'])) {
  $sel_isbn = $_GET['isbn'];
  $sel_author_name = $_GET['author_name'];
  $sel_author_surname = $_GET['author_surname'];
  $sel_book_name = $_GET['book_name'];
  $selBooks = $instanceBooks->filterBooks($sel_isbn, $sel_author_name, $sel_author_surname, $sel_book_name);
} else {
  $selBooks = $Books;
}
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
  <section>
    <div class="container my-3">
      <h2 class="h2">Searching books</h2>
      <form action="search.php" method="get">
        <input
          class="form-control my-2"
          name="isbn"
          type="text"
          placeholder="ISBN" />
        <input
          class="form-control my-2"
          name="author_name"
          type="text"
          placeholder="Author's name" />
        <input
          class="form-control my-2"
          name="author_surname"
          type="text"
          placeholder="Author's surname" />
        <input
          class="form-control my-2"
          name="book_name"
          type="text"
          placeholder="Book name" />
        <input
          class="btn green-bg text-white my-2"
          type="submit"
          value="Search" />
      </form>




      <?php
      if (sizeof($selBooks) > 0) {

      ?>
        <table class="table my-3">
          <tr>
            <th>ISBN</th>
            <th>Author's name</th>
            <th>Author's surname</th>
            <th>Book name</th>
            <th>Info</th>
          </tr>
          <?php foreach ($selBooks as $book): ?>
            <tr>
              <td><?php echo $book['isbn']; ?></td>
              <td><?php echo $book['author_name']; ?></td>
              <td><?php echo $book['author_surname']; ?></td>
              <td><?php echo $book['book_name']; ?></td>
              <td><?php echo $book['info']; ?></td>
              <!-- <td>
                <a class="btn btn-warning" href="edit.php?id=<?php echo $book['id']; ?>">Edit</a>
                <a class="btn btn-warning" href="index.php?delete=<?php echo $book['id']; ?>" onclick="return confirm('Opravdu chcete smazat toto auto?');">Delete</a>
              </td> -->
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