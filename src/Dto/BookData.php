<?php


namespace App\Dto;


use App\Entity\Author;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

class BookData
{
    /**
     * @var Uuid
     */
    public Uuid $id;

    /**
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "Title must be at least {{ limit }} characters long",
     *      maxMessage = "Title cannot be longer than {{ limit }} characters"
     * )
     * @var string
     */
    public string $title;

    /**
     * @Assert\Range(
     *      min = 0,
     *      max = YEAR,
     *      notInRangeMessage = "Year range must be between {{ min }} and {{ max }}",
     * )
     * @var int
     */
    public int $year;

    /**
     * @var Author
     */
    public Author $author;
}