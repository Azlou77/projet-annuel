<?php

namespace App\Entity;

use App\Repository\FilesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FilesRepository::class)]
class Files
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $size = null;

    #[ORM\Column(length: 255)]
    private ?string $extension = null;

    




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): static
    {
        $this->size = $size;

        return $this;
    }

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function setExtension(string $extension): static
    {
        $this->extension = $extension;

        return $this;
    }
}
