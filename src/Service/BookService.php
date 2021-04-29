<?php

namespace App\Service;

use App\Entity\Book;
use App\Repository\BookRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;

class BookService
{
    /**
     * @var BookRepositoryInterface
     */
    private BookRepositoryInterface $bookRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(BookRepositoryInterface $bookRepository, EntityManagerInterface $entityManager)
    {
        $this->bookRepository = $bookRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @param FormInterface $form
     */
    public function handleCreate(FormInterface $form)
    {
        $bookData = $form->getData();
        $book = new Book();

        $book->setTitle($bookData->title);
        $book->setYear($bookData->year);
        $book->setAuthor($bookData->author);

        $this->entityManager->persist($book);
        $this->entityManager->flush();

    }
}