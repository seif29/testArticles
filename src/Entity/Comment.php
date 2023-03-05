<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Serializer\Expose]
    #[Serializer\Groups(['API_GET'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Serializer\Expose]
    #[Serializer\Groups(['API_GET'])]
    private ?string $content = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'responses')]
    private ?self $parent = null;

    #[ORM\OneToMany(mappedBy: 'parent', targetEntity: Comment::class)]
    #[Serializer\Expose]
    #[Serializer\Groups(['API_GET'])]
    private Collection $responses;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    private ?Page $page = null;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Serializer\Expose]
    #[Serializer\Groups(['API_GET'])]
    private \DateTime $created;

    #[ORM\Column(name: 'updated', type: Types::DATETIME_MUTABLE)]
    #[Gedmo\Timestampable]
    #[Serializer\Expose]
    #[Serializer\Groups(['API_GET'])]
    private \DateTime $updated;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[Serializer\Expose]
    #[Serializer\Groups(['API_GET'])]
    private ?User $user = null;

    public function __construct()
    {
        $this->responses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    public function getPage(): ?Page
    {
        return $this->page;
    }

    public function setPage(?Page $page): self
    {
        $this->page = $page;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getResponses(): Collection
    {
        return $this->responses;
    }

    public function addResponse(Comment $response): self
    {
        if (!$this->responses->contains($response)) {
            $this->responses->add($response);
            $response->setParent($this);
        }

        return $this;
    }

    public function removeResponse(Comment $response): self
    {
        if ($this->responses->removeElement($response)) {
            // set the owning side to null (unless already changed)
            if ($response->getParent() === $this) {
                $response->setParent(null);
            }
        }

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
}
