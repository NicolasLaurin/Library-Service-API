<?php
require_once("../database/connectionManager.php");

/**
 * @OA\Schema()
 */
class Books
{
  /**
   * The ISBN-13 of the book
   * @var string
   * @OA\Property()
   */
  public $ISBN;

  /**
   * The name of the book
   * @var string
   * @OA\Property()
   */
  public $book_name;

  /**
   * The name of the author
   * @var string
   * @OA\Property()
   */
  public $author_name;

  /**
   * The category, or genre, that best classifies the book. (e.g.: Science-Fiction, Short-story, Memoir, etc...)
   * @var string
   * @OA\Property()
   */
  public $category_name;

  /**
   * The format of the book. (e.g.: Paperback, Hardcover, E-book, Audiobook, Mass Market Paperback)
   * @var string
   * @OA\Property()
   */
  public $book_type;

  /**
   * The number of pages in the book.
   * @var integer
   * @OA\Property()
   */
  public $num_of_pages;

  private $connectionManager;
  private $dbConnection;

  function __construct()
  {
    $this->connectionManager = new ConnectionManager();
    $this->dbConnection = $this->connectionManager->getConnection();
  }

  function getAllBooks()
  {
    $query = "SELECT * FROM books";

    $statement = $this->dbConnection->prepare($query);

    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  function getBookByISBN($ISBN)
  {
    $query = "SELECT * FROM books WHERE ISBN = " . $ISBN;

    $statement = $this->dbConnection->prepare($query);

    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  function insert()
  {
    $query = "INSERT INTO books(ISBN, book_name, author_name, category_name, book_type, num_of_pages) VALUES(:ISBN, :book_name, :author_name, :category_name, :book_type, :num_of_pages)";

    $statement = $this->dbConnection->prepare($query);

    // try {
    return $statement->execute(['ISBN' => $this->ISBN, 'book_name' => $this->book_name, 'author_name' => $this->author_name, 'category_name' => $this->category_name, 'book_type' => $this->book_type, 'num_of_pages' => $this->num_of_pages]);
    // } catch (PDOException $e) {
    //   if ($e->errorInfo[1] == 1062) { // if duplicate entry, do something else
    //     return $e;
    //   } else { // an error other than duplicate entry occurred

    //   }
    // }
  }

  function update()
  {
    $query = "UPDATE books SET book_name = :book_name, author_name = :author_name, category_name = :category_name, book_type = :book_type, num_of_pages = :num_of_pages WHERE ISBN = :ISBN";

    $statement = $this->dbConnection->prepare($query);

    return $statement->execute(['ISBN' => $this->ISBN, 'book_name' => $this->book_name, 'author_name' => $this->author_name, 'category_name' => $this->category_name, 'book_type' => $this->book_type, 'num_of_pages' => $this->num_of_pages]);
  }

  function delete()
  {
    $query = "DELETE FROM books WHERE ISBN = :ISBN";

    $statement = $this->dbConnection->prepare($query);

    return $statement->execute(['ISBN' => $this->ISBN]);
  }

  function getBookByBookName($book_name)
  {
    $query = "SELECT * FROM books WHERE book_name = :book_name";

    $statement = $this->dbConnection->prepare($query);

    $statement->execute(['book_name' => $book_name]);

    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  function getBookByAuthorName($author_name)
  {
    $query = "SELECT * FROM books WHERE author_name = :author_name";

    $statement = $this->dbConnection->prepare($query);

    $statement->execute(['author_name' => $author_name]);

    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  function getBookByCategoryName($category_name)
  {
    $query = "SELECT * FROM books WHERE category_name = :category_name";

    $statement = $this->dbConnection->prepare($query);

    $statement->execute(['category_name' => $category_name]);

    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  function getBookByBookType($book_type)
  {
    $query = "SELECT * FROM books WHERE book_type = :book_type";

    $statement = $this->dbConnection->prepare($query);

    $statement->execute(['book_type' => $book_type]);

    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  function getBookByNumOfPages($num_of_pages)
  {
    $query = "SELECT * FROM books WHERE num_of_pages = :num_of_pages";

    $statement = $this->dbConnection->prepare($query);

    $statement->execute(['num_of_pages' => $num_of_pages]);

    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  function getBookByNumOfPagesGreater($num_of_pages)
  {
    $query = "SELECT * FROM books WHERE num_of_pages >= :num_of_pages";

    $statement = $this->dbConnection->prepare($query);

    $statement->execute(['num_of_pages' => $num_of_pages]);

    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  function getBookByNumOfPagesLower($num_of_pages)
  {
    $query = "SELECT * FROM books WHERE num_of_pages <= :num_of_pages";

    $statement = $this->dbConnection->prepare($query);

    $statement->execute(['num_of_pages' => $num_of_pages]);

    return $statement->fetch(PDO::FETCH_ASSOC);
  }
}
