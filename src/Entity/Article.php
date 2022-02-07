<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\PrePersist;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ArticleRepository::class), HasLifecycleCallbacks]
#[Vich\Uploadable]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'text')]
    private $content;

    #[ORM\Column(type: 'string', length: 255)]
    private $cover;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTime $date_created;

    #[ORM\Column(type: 'string', length: 255)]
    #[Gedmo\Slug(fields: ['title'])]
    private $slug;

    #[Vich\UploadableField(mapping: 'covers', fileNameProperty: 'cover')]
    private ?File $imageFile = null;

    public function setImageFile(File $cover = null)
    {
        $this->imageFile = $cover;
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setCover($cover)
    {
        $this->cover = $cover;
    }

    public function getCover()
    {
        return $this->cover;
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

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getDateCreated(): ?\DateTime
    {
        return $this->date_created;
    }

    #[PrePersist]
    public function setDateCreated(): self
    {
        $this->date_created = new \DateTime();
        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function __toString(): string
    {
        return $this->cover;
    }
}
