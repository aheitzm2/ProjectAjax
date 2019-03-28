<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PhotoRepository")
 */
class Photo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("photo")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Vous devez sélectionner un fichier .jpg")
     * @Assert\File(mimeTypes={ "image/jpeg" }, mimeTypesMessage="Vous devez importer une image .JPG ou .JPEG")
     * @Groups("photo")
     */
    private $path;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=6)
     * @Groups("photo")
     * @Assert\Type(type="float", message="Vous devez rentrer une latitude valide.")
     */
    private $latitude;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=6)
     * @Groups("photo")
     * @Assert\Type(type="float", message="Vous devez rentrer une longitude valide.")
     */
    private $longitude;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ville", inversedBy="photos")
     */
    private $ville;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

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
}
