<?php

declare(strict_types=1);

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="MovieRepository")
 * @ORM\Table(name="movie")
 */
class Movie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;
    /** @ORM\Column(type="string") */
    private ?string $title = null;
    /** @ORM\Column(type="integer") */
    private ?int $rating = null;
    /** @ORM\Column(type="boolean") */
    private bool $isMainCharacter = false;
    /** @ORM\Column(type="date", nullable=true) */
    private ?DateTime $releasedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(?int $rating): void
    {
        $this->rating = $rating;
    }

    public function isMainCharacter(): bool
    {
        return $this->isMainCharacter;
    }

    public function setIsMainCharacter(bool $isMainCharacter): void
    {
        $this->isMainCharacter = $isMainCharacter;
    }

    public function getReleasedAt(): ?DateTime
    {
        return $this->releasedAt;
    }

    public function setReleasedAt(?DateTime $releasedAt): void
    {
        $this->releasedAt = $releasedAt;
    }
}
