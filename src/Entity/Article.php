<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 * @Vich\Uploadable
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=3000)
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string|null
     */
    private $imageName;

    /**
     * @Vich\UploadableField(mapping="articles", fileNameProperty="imageName")
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime|null
     */
    private $updatedAt;


    /**
     * @ORM\Column(type="datetime")
     *
     */
    private $created_at;

    /**
     * @ORM\Column(type="integer")
     */
    private $author_id;


    /**
     * @ORM\Column(type="boolean")
     */
    private $published;

    /**
     * @ORM\Column(type="boolean")
     */
    private $miseAvant;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Categorie", inversedBy="article")
     */
    private $categories;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->created_at = new \DateTime(date('Y-m-d H:i:s'));
        $this->author_id = 10;
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt()
    {
        $this->created_at = new \DateTime(date('Y-m-d H:i:s'));

        return $this;
    }

    public function getAuthorId(): ?int
    {
        return $this->author_id;
    }

    public function setAuthorId(int $author_id): self
    {
        $this->author_id = 10;

        return $this;
    }


    public function getPublished(): ?bool
    {
        return $this->published;
    }


    public function setPublished(bool $published): self
    {
        $this->published = $published;
        return $this;
    }



    public function getMiseAvant(): ?bool
    {
        return $this->miseAvant;
    }

    public function setMiseAvant(bool $miseAvant): self
    {
        $this->miseAvant = $miseAvant;

        return $this;
    }

    /**
     * @return Collection|Categorie[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->addArticle($this);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
            $category->removeArticle($this);
        }

        return $this;
    }

    /**
     * @return null|string
     */
    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    /**
     * @param null|string $imageName
     * @return Article
     */
    public function setImageName(?string $imageName): Article
    {
        $this->imageName = $imageName;
        return $this;
    }

    /**
     * @return null|File
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param null|File $imageFile
     * @return Article
     */
    public function setImageFile(?File $imageFile): Article
    {
        $this->imageFile = $imageFile;
        if ($this->imageFile instanceof UploadedFile) {
            $this->updatedAt = new \DateTime('now');
        }
        return $this;
    }




}
