<?php


namespace App\Repository;
use App\Entity\Author;

interface AuthorRepositoryInterface
{
    /**
     * @param Author $author
     * @return $this
     */
    public function setCreate(Author $author): self;

    /**
     * @param Author $author
     * @return $this
     */
    public function setSave(Author $author): self;
}