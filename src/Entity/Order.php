<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 */
class Order
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $orderNumber;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $paymentDate;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $paymentReference;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OrderContent", mappedBy="orderRef")
     */
    private $orderContents;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PaymentMethod", inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $paymentMethod;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Delivery", mappedBy="orderRef", orphanRemoval=true)
     */
    private $deliveries;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\OrderStatus", inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $orderStatus;

    public function __construct()
    {
        $this->orderContents = new ArrayCollection();
        $this->deliveries = new ArrayCollection();
    }


    // public function __construct()
    // {
       
    // }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getOrderNumber(): ?string
    {
        return $this->orderNumber;
    }

    public function setOrderNumber(string $orderNumber): self
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    public function getPaymentDate(): ?\DateTimeInterface
    {
        return $this->paymentDate;
    }

    public function setPaymentDate(?\DateTimeInterface $paymentDate): self
    {
        $this->paymentDate = $paymentDate;

        return $this;
    }

    public function getPaymentReference(): ?string
    {
        return $this->paymentReference;
    }

    public function setPaymentReference(?string $paymentReference): self
    {
        $this->paymentReference = $paymentReference;

        return $this;
    }

    /**
     * @return Collection|OrderContent[]
     */
    public function getOrderContents(): Collection
    {
        return $this->orderContents;
    }

    public function addOrderContent(OrderContent $orderContent): self
    {
        if (!$this->orderContents->contains($orderContent)) {
            $this->orderContents[] = $orderContent;
            $orderContent->setOrderRef($this);
        }

        return $this;
    }

    public function removeOrderContent(OrderContent $orderContent): self
    {
        if ($this->orderContents->contains($orderContent)) {
            $this->orderContents->removeElement($orderContent);
            // set the owning side to null (unless already changed)
            if ($orderContent->getOrderRef() === $this) {
                $orderContent->setOrderRef(null);
            }
        }

        return $this;
    }

    public function getPaymentMethod(): ?PaymentMethod
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(?PaymentMethod $paymentMethod): self
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Delivery[]
     */
    public function getDeliveries(): Collection
    {
        return $this->deliveries;
    }

    public function addDelivery(Delivery $delivery): self
    {
        if (!$this->deliveries->contains($delivery)) {
            $this->deliveries[] = $delivery;
            $delivery->setOrderRef($this);
        }

        return $this;
    }

    public function removeDelivery(Delivery $delivery): self
    {
        if ($this->deliveries->contains($delivery)) {
            $this->deliveries->removeElement($delivery);
            // set the owning side to null (unless already changed)
            if ($delivery->getOrderRef() === $this) {
                $delivery->setOrderRef(null);
            }
        }

        return $this;
    }

    public function getOrderStatus(): ?OrderStatus
    {
        return $this->orderStatus;
    }

    public function setOrderStatus(?OrderStatus $orderStatus): self
    {
        $this->orderStatus = $orderStatus;

        return $this;
    }

}
