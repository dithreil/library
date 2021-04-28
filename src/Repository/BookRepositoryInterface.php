<?php


namespace App\Repository;
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
}