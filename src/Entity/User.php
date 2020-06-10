<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
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
     * @ORM\Column(type="string", length=180, unique=true, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $last_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pseudo;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_of_birth;

    /**
     * @ORM\Column(type="json")
     */
    private $days = [];

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Timetable", mappedBy="user")
     */
    private $timetables;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NotebookTask", mappedBy="user")
     */
    private $notebookTasks;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $google;

    public function __construct()
    {
        $this->timetables = new ArrayCollection();
        $this->notebookTasks = new ArrayCollection();
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
    public function getUsername(): string
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
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(?string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->date_of_birth;
    }

    public function setDateOfBirth(?\DateTimeInterface $date_of_birth): self
    {
        $this->date_of_birth = $date_of_birth;

        return $this;
    }

    public function getDays(): ?array
    {
        return $this->days;
    }

    public function setDays(array $days): self
    {
        $this->days = $days;

        return $this;
    }

    /**
     * @return Collection|Timetable[]
     */
    public function getTimetables(): Collection
    {
        return $this->timetables;
    }

    public function addTimetable(Timetable $timetable): self
    {
        if (!$this->timetables->contains($timetable)) {
            $this->timetables[] = $timetable;
            $timetable->setUser($this);
        }

        return $this;
    }

    public function removeTimetable(Timetable $timetable): self
    {
        if ($this->timetables->contains($timetable)) {
            $this->timetables->removeElement($timetable);
            // set the owning side to null (unless already changed)
            if ($timetable->getUser() === $this) {
                $timetable->setUser(null);
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
            $notebookTask->setUser($this);
        }

        return $this;
    }

    public function removeNotebookTask(NotebookTask $notebookTask): self
    {
        if ($this->notebookTasks->contains($notebookTask)) {
            $this->notebookTasks->removeElement($notebookTask);
            // set the owning side to null (unless already changed)
            if ($notebookTask->getUser() === $this) {
                $notebookTask->setUser(null);
            }
        }

        return $this;
    }

    public function getGoogle(): ?string
    {
        return $this->google;
    }

    public function setGoogle(?string $google): self
    {
        $this->google = $google;

        return $this;
    }
}
