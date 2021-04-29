<?php


namespace App\Repository;
use App\Entity\Author;
use App\Entity\Book;

interface BookRepositoryInterface
{

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