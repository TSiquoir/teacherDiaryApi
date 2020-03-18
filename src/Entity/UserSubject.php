<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserSubjectRepository")
 */
class UserSubject
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
     * @ORM\Column(type="string", length=255)
     */
    private $color;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="userSubjects")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TimetableTask", mappedBy="subject")
     */
    private $timetableTasks;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NotebookTask", mappedBy="subject")
     */
    private $notebookTasks;

    public function __construct()
    {
        $this->timetableTasks = new ArrayCollection();
        $this->notebookTasks = new ArrayCollection();
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

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

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
            $timetableTask->setSubject($this);
        }

        return $this;
    }

    public function removeTimetableTask(TimetableTask $timetableTask): self
    {
        if ($this->timetableTasks->contains($timetableTask)) {
            $this->timetableTasks->removeElement($timetableTask);
            // set the owning side to null (unless already changed)
            if ($timetableTask->getSubject() === $this) {
                $timetableTask->setSubject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|NotebookTask[]
     */
    public function getNotebookTasks(): Collection
    {
        return $this->notebookTasks;
    }

    public function addNotebookTask(NotebookTask $notebookTask): self
    {
        if (!$this->notebookTasks->contains($notebookTask)) {
            $this->notebookTasks[] = $notebookTask;
            $notebookTask->setSubject($this);
        }

        return $this;
    }

    public function removeNotebookTask(NotebookTask $notebookTask): self
    {
        if ($this->notebookTasks->contains($notebookTask)) {
            $this->notebookTasks->removeElement($notebookTask);
            // set the owning side to null (unless already changed)
            if ($notebookTask->getSubject() === $this) {
                $notebookTask->setSubject(null);
            }
        }

        return $this;
    }
}
