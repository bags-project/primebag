<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity("email")
 */
class User implements UserInterface 
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Length(
     * min = 3,
     * max = 50,
     * minMessage = "Votre prénom doit dépassé 3 caractères.",
     * maxMessage = "Votre prénom doit ne doit pas dépassé 50 caractères."
     * )
     * @Assert\NotBlank(
     * message ="Vous devez remplir votre prénom."
     * )
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Length(
     * min = 3,
     * max = 50,
     * minMessage = "Votre nom doit dépassé 3 caractères.",
     * maxMessage = "Votre nom doit ne doit pas dépassé 50 caractères."
     * )
     * @Assert\NotBlank(
     * message ="Vous devez remplir votre nom."
     * )
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     * message ="Vous devez remplir votre adresse."
     * )
     */
    private $address;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $secondaryAddress;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $phoneNumber;

    /**
     * @var string $email
     * @ORM\Column(type="string", length=100)
     * @ORM\Column(name="email", type="string", length=100, unique=true)
     * @Assert\Email(
     * message = "L'email '{{ value }}' n'est pas valide.",
     * checkMX = true
     * )
     * @Assert\NotBlank(
     *  message ="Votre adresse mail ne peut pas être vide."
     * )
     */
    private $email;

    /**
     * @Assert\NotBlank(
     *  message ="Vous n'avez pas rempli de mot de passe."
     * )
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="string", length=255)
     *  message ="Veuillez confirmer votre mot de passe"
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(
     * message ="Vous devez remplir votre nom de ville."
     * )
     */
    private $city;

    /**
    * @ORM\Column(type="string", length=10)
    * @Assert\NotBlank(
    * message ="Vous devez remplir votre code postal."
    * ) 
    */
    private $zipCode;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $countryName;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $countryCode;

    /**
     * @ORM\Column(type="array")
     */
    private $roles = [];

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Order", mappedBy="user", orphanRemoval=true)
     */
    private $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->roles = ["ROLE_USER"];
        $this->countryName = "France";
        $this->countryCode = "ISO 3166-2:FR";
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getSecondaryAddress(): ?string
    {
        return $this->secondaryAddress;
    }

    public function setSecondaryAddress(?string $secondaryAddress): self
    {
        $this->secondaryAddress = $secondaryAddress;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }
    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getCountryName(): ?string
    {
        return $this->countryName;
    }

    public function setCountryName(string $countryName): self
    {
        $this->countryName = $countryName;

        return $this;
    }

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    public function setCountryCode(string $countryCode): self
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->role = $roles;

        return $this;
    }

    public function __toString() {
        return 'bonjour';
    }

    /**
     * @return Collection|Order[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setUser($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->contains($order)) {
            $this->orders->removeElement($order);
            // set the owning side to null (unless already changed)
            if ($order->getUser() === $this) {
                $order->setUser(null);
            }
        }

        return $this;
    }

    public function eraseCredentials()
    {

    }

    public function getSalt(): ? string
    {
        return null;
    }

    public function getUsername(): ? string
    {


        return null;

    }
}
