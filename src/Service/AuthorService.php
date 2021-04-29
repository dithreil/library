<?php

namespace App\Service;


use App\Entity\Author;

use App\Repository\AuthorRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;

class AuthorService
{
    /**
     * @var AuthorRepositoryInterface
     */
    private AuthorRepositoryInterface $authorRepository;

    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    public function __construct(AuthorRepositoryInterface $authorRepository, EntityManagerInterface $entityManager)
    {
        $this->authorRepository = $authorRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @param FormInterface $form
     */
    public function handleCreate(FormInterface $form)
    {
        $authorData = $form->getData();

        $author = new Author();

        $author->setName($authorData->name);
        $author->setSurname($authorData->surname);

        $this->entityManager->persist($author);
        $this->entityManager->flush();
    }

    /**
     * @param string $id
     * @param FormInterface $form
     */
    public function handleUpdate(string $id, FormInterface $form)
    {
        $authorData = $form->getData();

        $author = $this->authorRepository->find($id);

        $author->setName($authorData->name);
        $author->setSurname($authorData->surname);

        $this->entityManager->flush();
    }
}