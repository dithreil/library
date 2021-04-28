<?php


namespace App\Repository;
use App\Entity\Author;
use App\Entity\Book;

interface BookRepositoryInterface
{
    /**
     * @param Book $book
     * @return $this
     */
    public function setCreate(Book $book): self;

    /**
     * @param Book $book
     * @return $this
     */
    public function setSave(Book $book): self;
    /**
     * @param $value
     * @return Book[] Returns an array of Book objects
     */
    public function findByTitleField($value);

    /**
     * @param Author $author
     * @return Book[] Returns an array of Book objects
     */
    public function findByAuthor(Author $author);
}