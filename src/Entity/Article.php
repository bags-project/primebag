<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Ajouté pour formulaire
use Symfony\Component\HttpFoundation\File\File; // Ajouté pour formulaire upload

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $poster;

    /**
     * @Assert\Url
     */
     private $posterUrl;

     /**
      * @Assert\Image(maxSize = "4096k")
      */
     private $posterFile;



    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $altPicture1;

    /**
     * @Assert\Url
     */
     private $altPicture1Url;

     /**
      * @Assert\Image(maxSize = "4096k")
      */
     private $altPicture1File;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $altPicture2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $altPicture3;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $reference;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $stock;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $matter;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $discount;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Category", inversedBy="articles")
     */
    private $categories;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Brand", inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $brand;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ArticleColor", inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $articleColor;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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



    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(?string $poster): self
    {
        $this->poster = $poster;

        return $this;
    }


    public function getPosterUrl(): ?string
    {
        return $this->posterUrl;
    }

    public function setPosterUrl(string $poster): self
    {
        $this->posterUrl = $poster;

        return $this;
    }

    public function getPosterFile()
    {
        return $this->posterFile;
    }

    public function setPosterFile($poster): self
    {
        $this->posterFile = $poster;

        return $this;
    }





    public function getAltPicture1(): ?string
    {
        return $this->altPicture1;
    }

    public function setAltPicture1(?string $altPicture1): self
    {
        $this->altPicture1 = $altPicture1;

        return $this;
    }

    public function getAltPicture1Url(): ?string
    {
        return $this->altPicture1Url;
    }

    public function setAltPicture1Url(?string $altPicture1): self
    {
        $this->altPicture1Url = $altPicture1;

        return $this;
    }

    public function getAltPicture1File(): ?string
    {
        return $this->altPicture1File;
    }

    public function setAltPicture1File(?string $altPicture1): self
    {
        $this->altPicture1File = $altPicture1;

        return $this;
    }






    public function getAltPicture2(): ?string
    {
        return $this->altPicture2;
    }

    public function setAltPicture2(?string $altPicture2): self
    {
        $this->altPicture2 = $altPicture2;

        return $this;
    }

    public function getAltPicture3(): ?string
    {
        return $this->altPicture3;
    }

    public function setAltPicture3(?string $altPicture3): self
    {
        $this->altPicture3 = $altPicture3;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getMatter(): ?string
    {
        return $this->matter;
    }

    public function setMatter(string $matter): self
    {
        $this->matter = $matter;

        return $this;
    }

    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    public function setDiscount(?float $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getcategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $categories): self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
        }

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getArticleColor(): ?ArticleColor
    {
        return $this->articleColor;
    }

    public function setArticleColor(?ArticleColor $articleColor): self
    {
        $this->articleColor = $articleColor;

        return $this;
    }
}
