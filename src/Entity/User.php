<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{

    #[ORM\Id] //clé primaire
    #[ORM\GeneratedValue] //auto increment
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[Assert\Email(
        message: 'L\'email {{ value }} n\'est pas valide.',
    )]
    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[Assert\NotBlank]
    #[ORM\Column]
    private string $password ;

    #[Assert\NotBlank]
    #[ORM\Column(length: 255)]
    protected string $first_name;

    #[Assert\NotBlank]
    #[ORM\Column(length: 255)]
    protected string $last_name;

    #[Assert\NotBlank]
    #[ORM\Column(length: 255, unique:true)]
    private string $user_name;

    #[Assert\NotBlank]
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private \DateTimeInterface $birth_date;

    #[ORM\Column]
    private \DateTimeImmutable $created_at;

    #[ORM\OneToMany(mappedBy: 'order_user', targetEntity: Order::class)]
    private Collection $user_order;

    #[ORM\OneToMany(mappedBy: 'publi_user', targetEntity: Publication::class)]
    private Collection $publications;

    #[ORM\OneToMany(mappedBy: 'resa_user', targetEntity: Reservation::class)]
    private Collection $user_resa;

    #[ORM\OneToMany(mappedBy: 'bookmark_user', targetEntity: Bookmark::class)]
    private Collection $user_bookmarks;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $token = null;

    #[ORM\Column(type: 'boolean')]
    private bool $is_verified = false;

    function __construct(){ //constructeur
        $this->created_at = new \DatetimeImmutable(); //date du jour automatiquement
        $this->user_order = new ArrayCollection();
        $this->publications = new ArrayCollection();
        $this->user_resa = new ArrayCollection();
        $this->user_bookmarks = new ArrayCollection();
        $this->roles = ['ROLE_USER'];
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getUserName(): ?string
    {
        return $this->user_name;
    }

    public function setUserName(string $user_name): self
    {
        $this->user_name = $user_name;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birth_date;
    }

    public function setBirthDate(\DateTimeInterface $birth_date): self
    {
        $this->birth_date = $birth_date;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection<int, order>
     */
    public function getUserOrder(): Collection
    {
        return $this->user_order;
    }

    public function addUserOrder(Order $userOrder): self
    {
        if (!$this->user_order->contains($userOrder)) {
            $this->user_order->add($userOrder);
            $userOrder->setOrderUser($this);
        }

        return $this;
    }

    public function removeUserOrder(Order $userOrder): self
    {
        if ($this->user_order->removeElement($userOrder)) {
            // set the owning side to null (unless already changed)
            if ($userOrder->getOrderUser() === $this) {
                $userOrder->setOrderUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Publication>
     */
    public function getPublications(): Collection
    {
        return $this->publications;
    }

    public function addPublication(Publication $publication): self
    {
        if (!$this->publications->contains($publication)) {
            $this->publications->add($publication);
            $publication->setPubliUser($this);
        }

        return $this;
    }

    public function removePublication(Publication $publication): self
    {
        if ($this->publications->removeElement($publication)) {
            // set the owning side to null (unless already changed)
            if ($publication->getPubliUser() === $this) {
                $publication->setPubliUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getUserResa(): Collection
    {
        return $this->user_resa;
    }

    public function addUserResa(Reservation $userResa): self
    {
        if (!$this->user_resa->contains($userResa)) {
            $this->user_resa->add($userResa);
            $userResa->setResaUser($this);
        }

        return $this;
    }

    public function removeUserResa(Reservation $userResa): self
    {
        if ($this->user_resa->removeElement($userResa)) {
            // set the owning side to null (unless already changed)
            if ($userResa->getResaUser() === $this) {
                $userResa->setResaUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Bookmark>
     */
    public function getUserBookmarks(): Collection
    {
        return $this->user_bookmarks;
    }

    public function addUserBookmark(Bookmark $userBookmark): self
    {
        if (!$this->user_bookmarks->contains($userBookmark)) {
            $this->user_bookmarks->add($userBookmark);
            $userBookmark->setBookmarkUser($this);
        }

        return $this;
    }

    public function removeUserBookmark(Bookmark $userBookmark): self
    {
        if ($this->user_bookmarks->removeElement($userBookmark)) {
            // set the owning side to null (unless already changed)
            if ($userBookmark->getBookmarkUser() === $this) {
                $userBookmark->setBookmarkUser(null);
            }
        }

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getIsVerified(): ?bool
    {
        return $this->is_verified;
    }

    public function setIsVerified(?bool $is_verified): self
    {
        $this->is_verified = $is_verified;
        return $this;
    }
}

class Client extends User{

    public function __toString(){
        return  $this->first_name . ' ' .  $this->last_name;
    }
}








