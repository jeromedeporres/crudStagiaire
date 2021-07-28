<?php

namespace App\Entity;

use App\Repository\AdresseRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AdresseRepository::class)
 */
class Adresse
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     * @Assert\NotBlank(message="Veuillez remplir le champ")
     */
    private $rue;

    /**
     * @ORM\Column(type="string", length=5)
     * @Assert\Type(type="digit")
     * @Assert\NotBlank(message="Veuillez remplir le champ")
     * @Assert\Length(min = 5, max = 5, minMessage = "codepostal {{ limit }} characters min",maxMessage = "codepostal {{ limit }} characters max")
     */
    private $codePostal;

    /**
     * @ORM\Column(type="string", length=80)
     * @Assert\NotBlank(message="Veuillez remplir le champ")
     */
    private $ville;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(string $rue): self
    {
        $this->rue = $rue;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }
}
