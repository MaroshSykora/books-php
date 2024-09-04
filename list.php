<?php
// Vložení souborů s definicemi tříd
require_once('Books.php');
include('DbConnect.php');

// Vytvoření instance třídy DbConnect a získání připojení
$conn = new DbConnect();
$dbConnection = $conn->connect();

// Vytvoření instance třídy Books
$instanceBooks = new Books($dbConnection);

// Získání všech knih
$books = $instanceBooks->getBooks();

// Zpracování mazání knihy
if (isset($_GET['delete'])) {
  $bookIsbn = $_GET['delete'];
  $instanceBooks->deleteBook($bookIsbn);
  header("Location: list.php"); // Přesměrování na seznam knih
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./scss/custom.css" rel="stylesheet">
  <title>Seznam knih</title>
  <style>
    /* Optional styling */
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
              <a class="nav-link" href="add.php">Add</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="list.php">List</a>
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
  <section class="container my-5">
    <?php if (sizeof($books) > 0): ?>
      <table class="table">
        <thead>
          <tr>
            <th>ISBN</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Book Name</th>
            <th>Info</th>
            <!-- <th>Actions</th> -->
          </tr>
        </thead>
        <tbody>
          <?php foreach ($books as $book): ?>
            <tr>
              <td><?php echo htmlspecialchars($book['isbn']); ?></td>
              <td><?php echo htmlspecialchars($book['author_name']); ?></td>
              <td><?php echo htmlspecialchars($book['author_surname']); ?></td>
              <td><?php echo htmlspecialchars($book['book_name']); ?></td>
              <td><?php echo htmlspecialchars($book['info']); ?></td>
              <!-- <td>
                <a class="btn btn-warning" href="index.php?delete=<?php echo urlencode($book['isbn']); ?>" onclick="return confirm('Opravdu chcete smazat tuto knihu?');">Smazat</a>
              </td> -->
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p>Žádné knihy k zobrazení</p>
    <?php endif; ?>
  </section>
  <!-- main konec -->

  <!-- SKRIPT BOOTSTRAP -->
  <script src="./bootstrap.bundle.min.js"></script>
  <!-- ^^^^^ -->
</body>

</html>