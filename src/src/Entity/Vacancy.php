<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\VacancyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=VacancyRepository::class)
 * @ApiFilter(SearchFilter::class,properties={"desired_skills"})
 */
class Vacancy
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
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $wage;

    /**
     * @ORM\ManyToMany(targetEntity=Skill::class, inversedBy="vacancies")
     */
    private $desired_skills;

    public function __construct()
    {
        $this->desired_skills = new ArrayCollection();
    }

    public function getId()
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getWage(): ?float
    {
        return $this->wage;
    }

    public function setWage(float $wage): self
    {
        $this->wage = $wage;

        return $this;
    }

    /**
     * @return Collection<int, Skill>
     */
    public function getDesiredSkills(): Collection
    {
        return $this->desired_skills;
    }

    public function addDesiredSkill(Skill $desiredSkill): self
    {
        if (!$this->desired_skills->contains($desiredSkill)) {
            $this->desired_skills[] = $desiredSkill;
        }

        return $this;
    }

    public function removeDesiredSkill(Skill $desiredSkill): self
    {
        $this->desired_skills->removeElement($desiredSkill);

        return $this;
    }
}
