<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER,
                options:["unsigned" => true],
    )  ]
    private ?int $id = null;

    #[ORM\Column(length: 120)]
    private ?string $Title = null;

    #[ORM\Column(type: Types::STRING,
        length: 121,
        unique: true,
    )]
    private ?string $TitleSlug = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE,
        nullable: true,
        options: ["default" => "CURRENT_TIMESTAMP"],
    )]
    private ?\DateTimeInterface $DatePost = null;

    #[ORM\ManyToMany(targetEntity: Rubrique::class, inversedBy: 'm2mPost')]
    private Collection $m2mRubrique;

    public function __construct()
    {
        $this->m2mRubrique = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): static
    {
        $this->Title = $Title;

        return $this;
    }

    public function getTitleSlug(): ?string
    {
        return $this->TitleSlug;
    }

    public function setTitleSlug(string $TitleSlug): static
    {
        $this->TitleSlug = $TitleSlug;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getDatePost(): ?\DateTimeInterface
    {
        return $this->DatePost;
    }

    public function setDatePost(?\DateTimeInterface $DatePost): static
    {
        $this->DatePost = $DatePost;

        return $this;
    }

    /**
     * @return Collection<int, Rubrique>
     */
    public function getM2mRubrique(): Collection
    {
        return $this->m2mRubrique;
    }

    public function addM2mRubrique(Rubrique $m2mRubrique): static
    {
        if (!$this->m2mRubrique->contains($m2mRubrique)) {
            $this->m2mRubrique->add($m2mRubrique);
        }

        return $this;
    }

    public function removeM2mRubrique(Rubrique $m2mRubrique): static
    {
        $this->m2mRubrique->removeElement($m2mRubrique);

        return $this;
    }
}
