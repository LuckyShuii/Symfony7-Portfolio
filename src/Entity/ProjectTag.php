<?php

namespace App\Entity;

use App\Repository\ProjectTagRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectTagRepository::class)]
class ProjectTag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'projectTags')]
    private ?Project $project = null;

    #[ORM\ManyToOne(inversedBy: 'projectTags')]
    private ?Tags $tag = null;

    #[ORM\Column(nullable: true)]
    private ?bool $main = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): static
    {
        $this->project = $project;

        return $this;
    }

    public function getTag(): ?Tags
    {
        return $this->tag;
    }

    public function setTag(?Tags $tag): static
    {
        $this->tag = $tag;

        return $this;
    }

    public function isMain(): ?bool
    {
        return $this->main;
    }

    public function setMain(?bool $main): static
    {
        $this->main = $main;

        return $this;
    }
}
