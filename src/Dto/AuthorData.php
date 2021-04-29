<?php


namespace App\Dto;

use Doctrine\Common\Collections\Collection;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

class AuthorData
{
    /**
     * @var Uuid
     */
    public Uuid $id;

    /**
     * @Assert\Length(
     *      min = 2,
     *      max = 150,
     *      minMessage = "Name must be at least {{ limit }} characters long",
     *      maxMessage = "Name cannot be longer than {{ limit }} characters"
     * )
     * @var string
     */
    public string $name;

    /**
     * @Assert\Length(
     *      min = 2,
     *      max = 150,
     *      minMessage = "Surname must be at least {{ limit }} characters long",
     *      maxMessage = "Surname cannot be longer than {{ limit }} characters"
     * )
     * @var string|null
     */
    public ?string $surname;

    /**
     * @var Collection
     */
    public Collection $books;
}