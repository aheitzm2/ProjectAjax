<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VilleRepository")
 */
class Ville
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("ville")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("ville")
     * @Assert\Length(min="3", max="60", minMessage="Le nom de la ville doit comporter au minimum 3 caractère et au maximum 60.")
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Photo", mappedBy="ville")
     * @Groups("ville")
     */
    private $photos;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=6)
     * @Groups("ville")
     * @Assert\Type(type="float", message="Vous devez rentrer une latitude valide.")
     */
    private $latitude;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=6)
     * @Groups("ville")
     * @Assert\Type(type="float", message="Vous devez rentrer une longitude valide.")
     */
    private $longitude;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Partie", mappedBy="ville")
     */
    private $parties;

    public function __construct()
    {
        $this->parties = new ArrayCollection();
        $this->photos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Photo[]
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photo $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos[] = $photo;
            $photo->setVille($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): self
    {
        if ($this->photos->contains($photo)) {
            $this->photos->removeElement($photo);
            // set the owning side to null (unless already changed)
            if ($photo->getVille() === $this) {
                $photo->setVille(null);
            }
        }

        return $this;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function setLatitude($latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setLongitude($longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @return Collection|Partie[]
     */
    public function getParties(): Collection
    {
        return $this->parties;
    }

    public function addParty(Partie $party): self
    {
        if (!$this->parties->contains($party)) {
            $this->parties[] = $party;
            $party->setVille($this);
        }

        return $this;
    }

    public function removeParty(Partie $party): self
    {
        if ($this->parties->contains($party)) {
            $this->parties->removeElement($party);
            // set the owning side to null (unless already changed)
            if ($party->getVille() === $this) {
                $party->setVille(null);
            }
        }

        return $this;
    }
}
