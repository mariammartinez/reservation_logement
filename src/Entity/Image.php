<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 */
class Image
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $limage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $caption;

    /**
     * @ORM\ManyToOne(targetEntity=add::class, inversedBy="images")
     * @ORM\JoinColumn(nullable=false)
     */
    private $add;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLimage(): ?string
    {
        return $this->limage;
    }

    public function setLimage(string $limage): self
    {
        $this->limage = $limage;

        return $this;
    }

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function setCaption(string $caption): self
    {
        $this->caption = $caption;

        return $this;
    }

    public function getAdd(): ?add
    {
        return $this->add;
    }

    public function setAdd(?add $add): self
    {
        $this->add = $add;

        return $this;
    }
}
