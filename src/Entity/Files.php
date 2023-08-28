<?php

namespace App\Entity;

use App\Repository\FilesRepository;
use Doctrine\DBAL\Types\Types;
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

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $size = null;

    #[ORM\Column(length: 255)]
    private ?string $files_Type = null;

    #[ORM\Column(length: 255)]
    private ?string $files_Url = null;

    #[ORM\ManyToOne(inversedBy: 'files')]
    private ?user $User = null;

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

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(string $size): static
    {
        $this->size = $size;

        return $this;
    }

    public function getFilesType(): ?string
    {
        return $this->files_Type;
    }

    public function setFilesType(string $files_Type): static
    {
        $this->files_Type = $files_Type;

        return $this;
    }

    public function getFilesUrl(): ?string
    {
        return $this->files_Url;
    }

    public function setFilesUrl(string $files_Url): static
    {
        $this->files_Url = $files_Url;

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->User;
    }

    public function setUser(?user $User): static
    {
        $this->User = $User;

        return $this;
    }
}
