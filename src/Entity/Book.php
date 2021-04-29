<?php

namespace App\Entity;

use Symfony\Bridge\Doctrine\IdGenerator\UuidV4Generator;
use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Uid\Uuid;


// константа - текущий год
define('YEAR', intval(date("Y")));

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 */
class Book
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true, nullable=false)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidV4Generator::class)
     */
    private Uuid $id;

    /**
     * @ORM\Column(type="string", length=255, unique=false, nullable=false)
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "Title must be at least {{ limit }} characters long",
     *      maxMessage = "Title cannot be longer than {{ limit }} characters"
     * )
     */
    private string $title;

    /**
     * @ORM\Column(type="smallint", unique=false, nullable=false)
     * @Assert\Range(
     *      min = 0,
     *      max = YEAR,
     *      notInRangeMessage = "Year range must be between {{ min }} and {{ max }}",
     * )
     */
    private int $year;

    /**
     * @ORM\ManyToOne(targetEntity=Author::class, inversedBy="books")
     * @ORM\JoinColumn(nullable=false)
     */
    private Author $author;

    public function __construct(
        string $title = "bk", int $year = 0 )
    {
        $this->id = Uuid::v4();
        $this->title = $title;
        $this->year = $year;

    }


    /**
     * @return Uuid
     */
    public function getId(): Uuid
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @param int $year
     * @return $this
     */
    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    /**
     * @return Author|null
     */
    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    /**
     * @param Author $author
     * @return $this
     */
    public function setAuthor(Author $author): self
    {
        $this->author = $author;

        return $this;
    }
}
