<?php


namespace App\Dto\Transformer;


use App\Dto\AuthorData;
use App\Entity\Author;

class AuthorToDataTransformer
{
public function transformAuthorToData(Author $author): AuthorData
{
    $ad = new AuthorData();

    $ad->id = $author->getId();
    $ad->name = $author->getName();
    $ad->surname = $author->getSurname();
    $ad->books = $author->getBooks();

    return $ad;
}
}