<?php


namespace App\Repository;
use App\Entity\Author;

interface AuthorRepositoryInterface
{
    /**
     * @param string $id
     * @return Author
     */
    public function findAuthorById(string $id): Author;
}