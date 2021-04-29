<?php

namespace App\Entity;

use Symfony\Bridge\Doctrine\IdGenerator\UuidV4Generator;
use App\Repository\AuthorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\UuidV4;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity(repositoryClass=AuthorRepository::class)
 */
class Author
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidV4Generator::class)
     */
    private Uuid $id;

    /**
     * @ORM\Column(type="string", length=150)
     * @Assert\Length(
     *      min = 2,
     *      max = 150,
     *      minMessage = "Name must be at least {{ limit }} characters long",
     *      maxMessage = "Name cannot be longer than {{ limit }} characters"
     * )
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     * @Assert\Length(
     *      min = 2,
     *      max = 150,
     *      minMessage = "Surname must be at least {{ limit }} characters long",
     *      maxMessage = "Surname cannot be longer than {{ limit }} characters"
     * )
     */
    private ?string $surname;

    /**
     * @ORM\OneToMany(targetEntity=Book::class, mappedBy="author", orphanRemoval=true)
     */
    private Collection $books;

    /**
     * Author constructor.
     * @param string $name
     * @param string|null $surname
     */
    public function __construct(string $name = "ar", string $surname = null )
    {
        $this->id = Uuid::v4();
        $this->name = $name;
        $this->surname = $surname;
        $this->books = new ArrayCollection();
    }

    /**
     * Author stringify.
     * @return string
     */
    public function __toString()
    {
        return $this->getName() . ' ' . $this->getSurname();
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSurname(): ?string
    {
        return $this->surname;
    }

    /**
     * @param string|null $surname
     * @return $this
     */
    public function setSurname(?string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * @return Collection|Book[]
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    /**
     * @param Book $book
     * @return $this
     */
    public function addBook(Book $book): self
    {
        if (!$this->books->contains($book)) {
            $this->books[] = $book;
            $book->setAuthor($this);
        }

        return $this;
    }

    /**
     * @param Book $book
     * @return $this
     */
    public function removeBook(Book $book): self
    {
        if ($this->books->removeElement($book)) {
            // set the owning side to null (unless already changed)
            if ($book->getAuthor() === $this) {
                $book->setAuthor(null);
            }
        }

        return $this;
    }
}
