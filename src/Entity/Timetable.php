<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TimetableRepository")
 */
class Timetable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="time")
     */
    private $time_start;

    /**
     * @ORM\Column(type="time")
     */
    private $time_end;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="timetables")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TimetableTask", mappedBy="timetable")
     */
    private $timetableTasks;

    public function __construct()
    {
        $this->timetableTasks = new ArrayCollection();
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

    public function getTimeStart(): ?\DateTimeInterface
    {
        return $this->time_start;
    }

    public function setTimeStart(\DateTimeInterface $time_start): self
    {
        $this->time_start = $time_start;

        return $this;
    }

    public function getTimeEnd(): ?\DateTimeInterface
    {
        return $this->time_end;
    }

    public function setTimeEnd(\DateTimeInterface $time_end): self
    {
        $this->time_end = $time_end;

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
     * @return Collection|TimetableTask[]
     */
    public function getTimetableTasks(): Collection
    {
        return $this->timetableTasks;
    }

    public function addTimetableTask(TimetableTask $timetableTask): self
    {
        if (!$this->timetableTasks->contains($timetableTask)) {
            $this->timetableTasks[] = $timetableTask;
            $timetableTask->setTimetable($this);
        }

        return $this;
    }

    public function removeTimetableTask(TimetableTask $timetableTask): self
    {
        if ($this->timetableTasks->contains($timetableTask)) {
            $this->timetableTasks->removeElement($timetableTask);
            // set the owning side to null (unless already changed)
            if ($timetableTask->getTimetable() === $this) {
                $timetableTask->setTimetable(null);
            }
        }

        return $this;
    }
}
