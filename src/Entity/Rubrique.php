<?php

namespace App\Entity;

use App\Repository\RubriqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RubriqueRepository::class)]
class Rubrique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(options:["unsigned" => true])]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $TitleRubrique = null;

    #[ORM\Column(length: 101, unique: true,)]
    private ?string $SlugRubrique = null;

    #[ORM\Column(length: 400, nullable: true)]
    private ?string $DescRubrique = null;

    #[ORM\ManyToMany(targetEntity: Post::class, mappedBy: 'm2mRubrique')]
    private Collection $m2mPost;

    public function __construct()
    {
        $this->m2mPost = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitleRubrique(): ?string
    {
        return $this->TitleRubrique;
    }

    public function setTitleRubrique(string $TitleRubrique): static
    {
        $this->TitleRubrique = $TitleRubrique;

        return $this;
    }

    public function getSlugRubrique(): ?string
    {
        return $this->SlugRubrique;
    }

    public function setSlugRubrique(string $SlugRubrique): static
    {
        $this->SlugRubrique = $SlugRubrique;

        return $this;
    }

    public function getDescRubrique(): ?string
    {
        return $this->DescRubrique;
    }

    public function setDescRubrique(?string $DescRubrique): static
    {
        $this->DescRubrique = $DescRubrique;

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getM2mPost(): Collection
    {
        return $this->m2mPost;
    }

    public function addM2mPost(Post $m2mPost): static
    {
        if (!$this->m2mPost->contains($m2mPost)) {
            $this->m2mPost->add($m2mPost);
            $m2mPost->addM2mRubrique($this);
        }

        return $this;
    }

    public function removeM2mPost(Post $m2mPost): static
    {
        if ($this->m2mPost->removeElement($m2mPost)) {
            $m2mPost->removeM2mRubrique($this);
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->getTitleRubrique();
    }
}
