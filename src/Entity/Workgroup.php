<?php

namespace App\Entity;

use App\Repository\WorkgroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WorkgroupRepository::class)]
class Workgroup
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 80)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'workgroup_id', targetEntity: Workshift::class)]
    private $workshifts;

    #[ORM\OneToMany(mappedBy: 'workgroup_id', targetEntity: User::class)]
    private $users;

    public function __construct()
    {
        $this->workshifts = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function __toString() {
        return $this->name;
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

    /**
     * @return Collection<int, Workshift>
     */
    public function getWorkshifts(): Collection
    {
        return $this->workshifts;
    }

    public function addWorkshift(Workshift $workshift): self
    {
        if (!$this->workshifts->contains($workshift)) {
            $this->workshifts[] = $workshift;
            $workshift->setWorkgroupId($this);
        }

        return $this;
    }

    public function removeWorkshift(Workshift $workshift): self
    {
        if ($this->workshifts->removeElement($workshift)) {
            // set the owning side to null (unless already changed)
            if ($workshift->getWorkgroupId() === $this) {
                $workshift->setWorkgroupId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setWorkgroupId($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getWorkgroupId() === $this) {
                $user->setWorkgroupId(null);
            }
        }

        return $this;
    }
}
