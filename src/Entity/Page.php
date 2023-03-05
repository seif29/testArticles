<?php

namespace App\Entity;

use App\Repository\PageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;

#[ORM\Entity(repositoryClass: PageRepository::class)]
class Page
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Serializer\Expose]
    #[Serializer\Groups(['API_GET'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Serializer\Expose]
    #[Serializer\Groups(['API_GET'])]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Serializer\Expose]
    #[Serializer\Groups(['API_GET'])]
    private ?string $content = null;

    #[Gedmo\Timestampable(on: 'create')]
    #[Serializer\Expose]
    #[Serializer\Groups(['API_GET'])]
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private \DateTime $created;

    #[ORM\Column(name: 'updated', type: Types::DATETIME_MUTABLE)]
    #[Gedmo\Timestampable]
    #[Serializer\Expose]
    #[Serializer\Groups(['API_GET'])]
    private \DateTime $updated;

    #[ORM\OneToMany(mappedBy: 'page', targetEntity: Comment::class)]
    private Collection $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

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
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setPage($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getPage() === $this) {
                $comment->setPage(null);
            }
        }

        return $this;
    }
}
