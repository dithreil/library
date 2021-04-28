<?php

namespace App\Entity;

use App\Repository\AuthorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Book;

/**
 * @ORM\Entity(repositoryClass=AuthorRepository::class)
 */
class Author
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $surname;

    /**
     * Один автор может написать множество книг
     * "@ORM\OneToMany(targetEntity="App\Entity\Book", mappedBy="author")
     */
    protected $books;

    /**
     * Author constructor.
     */
    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName():


    string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(?string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }


    public function getAuthor() : array
    {
        $author = [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'surname' => $this->getSurname()
        ];

        return $author;
    }


    public function getBooks() : ?Collection
    {
        return $this->books;
    }

    public function __toString() : string
    {
        return $this->getName().' '.$this->getSurname();
    }
}
