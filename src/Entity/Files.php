<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FileRepository")
 */
class Files
{

    
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]

    
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez fournir un nom pour le fichier.")
     */

     #[ORM\Column(type: 'string')]
     #[Assert\NotBlank(message: 'Veuillez fournir un nom pour le fichier.')]

    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez fournir un chemin pour le fichier.")
     */

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank(message: 'Veuillez fournir un chemin pour le fichier.')]
    private $path;

    /**
     * 
     * @ORM\Column(type="string", length=255)
     */

        
     #[ORM\Column(type: 'string')]
     private $brochureFilename;
 
     public function getBrochureFilename(): string
     {
         return $this->brochureFilename;
     }
 
     public function setBrochureFilename(string $brochureFilename): self
     {
         $this->brochureFilename = $brochureFilename;
 
         return $this;
     }
     

    // getters and setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): ?self
    {
        $this->id = $id;
        return $this;
    }


    public function getName(): ?string
    {
        return $this->name;
    }


    public function setName(string $name): ?self
    {
        $this->name = $name;
        return $this;
    }


    public function getPath(): ?string
    {
        return $this->path;
    }



    public function setPath(string $path): ?self
    {
        $this->path = $path;
        return $this;
    }


    public function __toString()
    {
        return $this->name;
    }   
}