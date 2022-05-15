<?php

namespace App\Entity;

use App\Repository\WorkshiftRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WorkshiftRepository::class)]
class Workshift
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $date;

    #[ORM\Column(type: 'smallint')]
    private $start;

    #[ORM\Column(type: 'smallint')]
    private $end;

    #[ORM\ManyToOne(targetEntity: Workgroup::class, inversedBy: 'workshifts')]
    private $workgroup_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getStart(): ?int
    {
        return $this->start;
    }

    public function setStart(int $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?int
    {
        return $this->end;
    }

    public function setEnd(int $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getWorkgroupId(): ?Workgroup
    {
        return $this->workgroup_id;
    }

    public function setWorkgroupId(?Workgroup $workgroup_id): self
    {
        $this->workgroup_id = $workgroup_id;

        return $this;
    }
}
