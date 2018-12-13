<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderContentRepository")
 */
class OrderContent
{
    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\Order", inversedBy="orderContents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $orderRef;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\Article")
     * @ORM\JoinColumn(nullable=false)
     */
    private $articleRef;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="float")
     */
    private $exclusiveOfTaxes;

    /**
     * @ORM\Column(type="float")
     */
    private $inclusiveOfTaxes;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $taxe;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderRef(): ?Order
    {
        return $this->orderRef;
    }

    public function setOrderRef(?Order $orderRef): self
    {
        $this->orderRef = $orderRef;

        return $this;
    }

    public function getArticleRef(): ?Article
    {
        return $this->articleRef;
    }

    public function setArticleRef(?Article $articleRef): self
    {
        $this->articleRef = $articleRef;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getExclusiveOfTaxes(): ?float
    {
        return $this->exclusiveOfTaxes;
    }

    public function setExclusiveOfTaxes(float $exclusiveOfTaxes): self
    {
        $this->exclusiveOfTaxes = $exclusiveOfTaxes;

        return $this;
    }

    public function getInclusiveOfTaxes(): ?float
    {
        return $this->inclusiveOfTaxes;
    }

    public function setInclusiveOfTaxes(float $inclusiveOfTaxes): self
    {
        $this->inclusiveOfTaxes = $inclusiveOfTaxes;

        return $this;
    }

    public function getTaxe(): ?float
    {
        return $this->taxe;
    }

    public function setTaxe(?float $taxe): self
    {
        $this->taxe = $taxe;

        return $this;
    }

}
