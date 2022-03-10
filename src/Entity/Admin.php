<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdminRepository::class)]
class Admin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $Matricule;

    #[ORM\Column(type: 'string', length: 255)]
    private $Roles;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?int
    {
        return $this->Matricule;
    }

    public function setMatricule(int $Matricule): self
    {
        $this->Matricule = $Matricule;

        return $this;
    }

    public function getRoles(): ?string
    {
        return $this->Roles;
    }

    public function setRoles(string $Roles): self
    {
        $this->Roles = $Roles;

        return $this;
    }
}
