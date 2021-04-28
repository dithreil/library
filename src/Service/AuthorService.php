<?php

namespace App\Service;

use App\Repository\AuthorRepositoryInterface;
use Symfony\Component\Form\FormInterface;

class AuthorService
{
    /**
     * @var AuthorRepositoryInterface
     */
    private $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }


    public function handleCreate(FormInterface $form)
    {
        $author = $form->getData();
        $this->authorRepository->setCreate($author);
    }
}