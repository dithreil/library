<?php

namespace App\Service;

use App\Repository\AuthorRepositoryInterface;
use App\Repository\BookRepositoryInterface;
use Symfony\Component\Form\FormInterface;

class BookService
{
    /**
     * @var BookRepositoryInterface
     */
    private $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }


    public function handleCreate(FormInterface $form)
    {
        $book = $form->getData();
        $this->bookRepository->setCreate($book);
    }
}