<?php
// ulozeni vsech aut tady (skripta str. 14)
// prisbnani parametru konstruktoru pripojeni
// predavat pripojeni ze skriptu kde bude pouzivat Books metody
// uchovat spojeni
// vytvoreni privatniho properties
// $p_dbConn parametr p_dbConn
// $stmt je statement
// oznameni funkci getBooks ze chci vysledek v asociativnim poli
// PDO nespolupracuje jen s mysql ale i s jinymi datatbazemi

class Books
{
  private $dbConn;
  // predani konstruktoru jako parametr pripojeni do db
  public function __construct($dbConn)
  {
    $this->dbConn = $dbConn;
  }
  // metoda, ktera vrati z db vsechna auta (bez parametru)
  // zaslani dotazu do databaze
  public function getBooks()
  {
    $query = 'SELECT * FROM book';
    $stmt = $this->dbConn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }


  // metoda, hledajici auta na zaklade zadanych parametru
  public function filterBooks($isbn, $author_name, $author_surname, $book_name)
  {
    // pravdivostni podminka 1=1 (zdelsena verze WHERE isbn LIKE '"%" . $p_isbn . "%"') zjistovani jestli je pri vyhledavani neco jako jako treba "skoda" nebo "Skoda"
    $sql = 'SELECT * FROM book WHERE 1=1';
    $params = [];


    //  prisbnani podminek do dotazu podle parametru
    // ochrana proti sequal injection
    if (!empty($isbn)) {
      $sql .= " AND isbn LIKE :isbn";
      $params[':isbn'] = '%' . $isbn . '%';
    }
    if (!empty($author_name)) {
      $sql .= " AND author_name LIKE :author_name";
      $params[':author_name'] = '%' . $author_name . '%';
    }
    if (!empty($author_surname)) {
      $sql .= " AND author_surname LIKE :author_surname";
      $params[':author_surname'] = '%' . $author_surname . '%';
    }

    //  priprava SQL dotazu
    $stmt = $this->dbConn->prepare($sql);

    // bindovani hodnot, pokud byly parametry prisbnany
    // projizdeni asociativniho pole
    foreach ($params as $param => $value) {
      $stmt->bindValue($param, $value, PDO::PARAM_STR);
      // vysledky
    }
    // Vykonání SQL dotazu
    $stmt->execute();
    // Návrat výsledků jako pole asociativních polí
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // mazani auta
  public function deleteBook($isbn)
  {
    $sql = 'DELETE FROM book WHERE isbn = :isbn';
    $stmt = $this->dbConn->prepare($sql);
    $stmt->bindParam(':isbn', $isbn, PDO::PARAM_INT);
    return $stmt->execute();
  }

  // vraceni konkretniho auta
  public function getBook($isbn)
  {
    $sql = 'SELECT * FROM book WHERE isbn = :isbn';
    $stmt = $this->dbConn->prepare($sql);
    $stmt->bindParam(':isbn', $isbn, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  // aktualizace existujiciho auta
  public function updateBook($isbn, $author_name, $author_surname, $book_name, $info)
  {
    $sql = "UPDATE book SET isbn = :isbn, author_name =:author_name, author_surname = :author_surname, book_name =:book_name, info = :info WHERE isbn = :isbn";
    $stmt = $this->dbConn->prepare($sql);
    $stmt->bindParam(':isbn', $isbn, PDO::PARAM_INT);
    $stmt->bindParam(':author_name', $author_name, PDO::PARAM_STR);
    $stmt->bindParam(':author_surname', $author_surname, PDO::PARAM_STR);
    $stmt->bindParam(':book_name', $book_name, PDO::PARAM_STR);
    $stmt->bindParam(':info', $info, PDO::PARAM_STR);
    return $stmt->execute();
  }

  // prisbnani auta
  public function addBook($isbn, $author_name, $author_surname, $book_name, $info)
  {
    $sql = "INSERT INTO book (isbn, author_name,author_surname, book_name, info) VALUES (:isbn, :author_name, :author_surname, :book_name, :info)";
    $stmt = $this->dbConn->prepare($sql);
    $stmt->bindParam(':isbn', $isbn, PDO::PARAM_INT);
    $stmt->bindParam(':author_name', $author_name, PDO::PARAM_STR);
    $stmt->bindParam(':author_surname', $author_surname, PDO::PARAM_STR);
    $stmt->bindParam(':book_name', $book_name, PDO::PARAM_STR);
    $stmt->bindParam(':info', $info, PDO::PARAM_STR);
    return $stmt->execute();
  }
}
