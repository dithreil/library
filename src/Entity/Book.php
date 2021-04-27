<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Author;

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 */
class Book
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="smallint")
     */
    private $year;

    /**
     * У книги есть единственный автор
     * @ORM\ManyToOne(targetEntity="App\Entity\Author", inversedBy="books")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    protected $author;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getBook(): array
    {
        $book = [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'year' => $this->getYear()
        ];

        return $book;
    }

    /**
     * @return mixed|array
     */
    public function getAuthor(): array
    {

        return $this->author->getAuthor();
    }


}
