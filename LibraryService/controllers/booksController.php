<?php
require_once("../model/books.php");

class BooksController
{
  function getAllBooks()
  {
    $books = new Books();
    return $books->getAllBooks();
  }

  function getBookByISBN($ISBN)
  {
    $books = new Books();
    return $books->getBookByISBN($ISBN);
  }

  function addBook($payloadArray)
  {
    // if (array_key_exists('ISBN', $payloadArray) && array_key_exists('book_name', $payloadArray) && array_key_exists('author_name', $payloadArray) && array_key_exists('category_name', $payloadArray) && array_key_exists('book_type', $payloadArray) && array_key_exists('num_of_pages', $payloadArray)) {
    $books = new Books();
    $books->ISBN = $payloadArray['ISBN'];
    $books->book_name = $payloadArray['book_name'];
    $books->author_name = $payloadArray['author_name'];
    $books->category_name = $payloadArray['category_name'];
    $books->book_type = $payloadArray['book_type'];
    $books->num_of_pages = $payloadArray['num_of_pages'];
    return $books->insert();
    // } else {
    //   return 'Invalid payload';
    // }
  }

  function validatePOSTRequestPayload($payloadArray)
  {
    if (array_key_exists('ISBN', $payloadArray) && array_key_exists('book_name', $payloadArray) && array_key_exists('author_name', $payloadArray) && array_key_exists('category_name', $payloadArray) && array_key_exists('book_type', $payloadArray) && array_key_exists('num_of_pages', $payloadArray)) {
      return true;
    }
    return false;
  }

  function updateBook($ISBN, $payloadArray)
  {
    $books = new Books();
    $books->ISBN = $ISBN;
    $books->book_name = $payloadArray['book_name'];
    $books->author_name = $payloadArray['author_name'];
    $books->category_name = $payloadArray['category_name'];
    $books->book_type = $payloadArray['book_type'];
    $books->num_of_pages = $payloadArray['num_of_pages'];
    return $books->update();
  }

  function validatePUTRequestPayload($payloadArray)
  {
    if (array_key_exists('book_name', $payloadArray) && array_key_exists('author_name', $payloadArray) && array_key_exists('category_name', $payloadArray) && array_key_exists('book_type', $payloadArray) && array_key_exists('num_of_pages', $payloadArray)) {
      return true;
    }
    return false;
  }

  function deleteBook($ISBN)
  {
    $books = new Books();
    $books->ISBN = $ISBN;
    return $books->delete();
  }

  function getBookByBookName($book_name)
  {
    $books = new Books();
    return $books->getBookByBookName($book_name);
  }

  function getBookByAuthorName($author_name)
  {
    $books = new Books();
    return $books->getBookByAuthorName($author_name);
  }

  function getBookByCategoryName($category_name)
  {
    $books = new Books();
    return $books->getBookByCategoryName($category_name);
  }

  function getBookByBookType($book_type)
  {
    $books = new Books();
    return $books->getBookByBookType($book_type);
  }

  function getBookByNumOfPages($num_of_pages)
  {
    $books = new Books();
    return $books->getBookByNumOfPages($num_of_pages);
  }

  function getBookByNumOfPagesGreater($num_of_pages)
  {
    $books = new Books();
    return $books->getBookByNumOfPagesGreater($num_of_pages);
  }

  function getBookByNumOfPagesLower($num_of_pages)
  {
    $books = new Books();
    return $books->getBookByNumOfPagesLower($num_of_pages);
  }
}
