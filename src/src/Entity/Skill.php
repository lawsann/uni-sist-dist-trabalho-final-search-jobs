<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SkillRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=SkillRepository::class)
 */
class Skill
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\ManyToMany(targetEntity=Professional::class, mappedBy="skills")
     */
    private $professionals;

    /**
     * @ORM\ManyToMany(targetEntity=Vacancy::class, mappedBy="desired_skills")
     */
    private $vacancies;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dev_type;

    public function __construct()
    {
        $this->professionals = new ArrayCollection();
        $this->vacancies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection<int, Professional>
     */
    public function getProfessionals(): Collection
    {
        return $this->professionals;
    }

    public function addProfessional(Professional $professional): self
    {
        if (!$this->professionals->contains($professional)) {
            $this->professionals[] = $professional;
            $professional->addSkill($this);
        }

        return $this;
    }

    public function removeProfessional(Professional $professional): self
    {
        if ($this->professionals->removeElement($professional)) {
            $professional->removeSkill($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Vacancy>
     */
    public function getVacancies(): Collection
    {
        return $this->vacancies;
    }

    public function addVacancy(Vacancy $vacancy): self
    {
        if (!$this->vacancies->contains($vacancy)) {
            $this->vacancies[] = $vacancy;
            $vacancy->addDesiredSkill($this);
        }

        return $this;
    }

    public function removeVacancy(Vacancy $vacancy): self
    {
        if ($this->vacancies->removeElement($vacancy)) {
            $vacancy->removeDesiredSkill($this);
        }

        return $this;
    }

    public function getDevType(): ?string
    {
        return $this->dev_type;
    }

    public function setDevType(?string $dev_type): self
    {
        $this->dev_type = $dev_type;

        return $this;
    }
}
