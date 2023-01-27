<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $client_name = null;

    #[ORM\Column(length: 100)]
    private ?string $client_surname = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $client_username = null;

    #[ORM\Column(length: 100)]
    private ?string $client_mail = null;

    #[ORM\Column(length: 100)]
    private ?string $client_pwd = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $client_bithdate = null;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: favoris::class)]
    private Collection $ajoute;

    public function __construct()
    {
        $this->ajoute = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClientName(): ?string
    {
        return $this->client_name;
    }

    public function setClientName(string $client_name): self
    {
        $this->client_name = $client_name;

        return $this;
    }

    public function getClientSurname(): ?string
    {
        return $this->client_surname;
    }

    public function setClientSurname(string $client_surname): self
    {
        $this->client_surname = $client_surname;

        return $this;
    }

    public function getClientUsername(): ?string
    {
        return $this->client_username;
    }

    public function setClientUsername(?string $client_username): self
    {
        $this->client_username = $client_username;

        return $this;
    }

    public function getClientMail(): ?string
    {
        return $this->client_mail;
    }

    public function setClientMail(string $client_mail): self
    {
        $this->client_mail = $client_mail;

        return $this;
    }

    public function getClientPwd(): ?string
    {
        return $this->client_pwd;
    }

    public function setClientPwd(string $client_pwd): self
    {
        $this->client_pwd = $client_pwd;

        return $this;
    }

    public function getClientBithdate(): ?\DateTimeInterface
    {
        return $this->client_bithdate;
    }

    public function setClientBithdate(\DateTimeInterface $client_bithdate): self
    {
        $this->client_bithdate = $client_bithdate;

        return $this;
    }

    /**
     * @return Collection<int, favoris>
     */
    public function getAjoute(): Collection
    {
        return $this->ajoute;
    }

    public function addAjoute(favoris $ajoute): self
    {
        if (!$this->ajoute->contains($ajoute)) {
            $this->ajoute->add($ajoute);
            $ajoute->setClient($this);
        }

        return $this;
    }

    public function removeAjoute(favoris $ajoute): self
    {
        if ($this->ajoute->removeElement($ajoute)) {
            // set the owning side to null (unless already changed)
            if ($ajoute->getClient() === $this) {
                $ajoute->setClient(null);
            }
        }

        return $this;
    }
}
