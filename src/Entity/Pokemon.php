<?php

namespace App\Entity;

use App\Repository\PokemonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PokemonRepository::class)]
class Pokemon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 4)]
    private ?string $pokedex_id = null;

    #[ORM\Column]
    private ?float $size = null;

    #[ORM\Column]
    private ?float $weight = null;

    #[ORM\Column(length: 255)]
    private ?string $sex = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imgSrc = null;

    #[ORM\ManyToOne(inversedBy: 'pokemon')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Talent $talent = null;

    /**
     * @var Collection<int, Type>
     */
    #[ORM\ManyToMany(targetEntity: Type::class, inversedBy: 'pokemon')]
    private Collection $type;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'preEvolutions')]
    private Collection $evolutions;

    /**
     * @var Collection<int, self>
     */
    #[ORM\ManyToMany(targetEntity: self::class, mappedBy: 'evolutions')]
    private Collection $preEvolutions;

    public function __construct()
    {
        $this->type = new ArrayCollection();
        $this->evolutions = new ArrayCollection();
        $this->preEvolutions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPokedexId(): ?string
    {
        return $this->pokedex_id;
    }

    public function setPokedexId(string $pokedex_id): self
    {
        $this->pokedex_id = $pokedex_id;

        return $this;
    }

    public function getSize(): ?float
    {
        return $this->size;
    }

    public function setSize(float $size): static
    {
        $this->size = $size;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(string $sex): static
    {
        $this->sex = $sex;

        return $this;
    }

    public function getImgSrc(): ?string
    {
        return $this->imgSrc;
    }

    public function setImgSrc(?string $imgSrc): static
    {
        $this->imgSrc = $imgSrc;

        return $this;
    }

    public function getTalent(): ?Talent
    {
        return $this->talent;
    }

    public function setTalent(?Talent $talent): static
    {
        $this->talent = $talent;

        return $this;
    }

    /**
     * @return Collection<int, Type>
     */
    public function getType(): Collection
    {
        return $this->type;
    }

    public function addType(Type $type): static
    {
        if (!$this->type->contains($type)) {
            $this->type->add($type);
        }

        return $this;
    }

    public function removeType(Type $type): static
    {
        $this->type->removeElement($type);

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getEvolutions(): Collection
    {
        return $this->evolutions;
    }

    public function addEvolution(self $evolution): static
    {
        if (!$this->evolutions->contains($evolution)) {
            $this->evolutions->add($evolution);
        }

        return $this;
    }

    public function removeEvolution(self $evolution): static
    {
        $this->evolutions->removeElement($evolution);

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getPreEvolutions(): Collection
    {
        return $this->preEvolutions;
    }

    public function addPreEvolution(self $preEvolution): static
    {
        if (!$this->preEvolutions->contains($preEvolution)) {
            $this->preEvolutions->add($preEvolution);
            $preEvolution->addEvolution($this);
        }

        return $this;
    }

    public function removePreEvolution(self $preEvolution): static
    {
        if ($this->preEvolutions->removeElement($preEvolution)) {
            $preEvolution->removeEvolution($this);
        }

        return $this;
    }
}
