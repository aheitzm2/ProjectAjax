<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PartieRepository")
 */
class Partie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("partie")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("partie")
     */
    private $pseudo;

    /**
     * @ORM\Column(type="integer")
     * @Groups("partie")
     */
    private $difficulte;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("partie")
     */
    private $token;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("partie")
     */
    private $points;

    /**
     * @ORM\Column(type="integer")
     * @Groups("partie")
     */
    private $avancement;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("partie")
     */
    private $playable;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ville", inversedBy="parties")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ville;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getDifficulte(): ?int
    {
        return $this->difficulte;
    }

    public function setDifficulte(int $difficulte): self
    {
        $this->difficulte = $difficulte;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(?int $points): self
    {
        $this->points = $points;

        return $this;
    }

    public function getAvancement(): ?int
    {
        return $this->avancement;
    }

    public function setAvancement(int $avancement): self
    {
        $this->avancement = $avancement;

        return $this;
    }

    public function getPlayable(): ?bool
    {
        return $this->playable;
    }

    public function setPlayable(bool $playable): self
    {
        $this->playable = $playable;

        return $this;
    }

    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    public function setVille(?Ville $ville): self
    {
        $this->ville = $ville;

        return $this;
    }
}
