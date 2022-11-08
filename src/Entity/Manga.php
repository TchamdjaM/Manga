<?php

namespace App\Entity;

use App\Repository\MangaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MangaRepository::class)
 */
class Manga
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column
     */
    private ?int $id = null;

    /**
     * @ORM\ManyToOne(inversedBy="mangas")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Mangaka $mangaka = null;

    /**
     * @ORM\Column(length=255)
     */
    private ?string $name = null;

    /**
     * @ORM\Column(type=Types::TEXT)
     */
    private ?string $description = null;

    /**
     * @ORM\Column
     */
    private ?int $nbTomes = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMangaka(): ?Mangaka
    {
        return $this->mangaka;
    }

    public function setMangaka(?Mangaka $mangaka): self
    {
        $this->mangaka = $mangaka;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getNbTomes(): ?int
    {
        return $this->nbTomes;
    }

    public function setNbTomes(int $nbTomes): self
    {
        $this->nbTomes = $nbTomes;

        return $this;
    }
}
