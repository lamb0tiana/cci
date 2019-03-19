<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity("name",message="Nom de votre article existe déjà.")
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
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $content;
    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ArticleCategorie", mappedBy="articles", cascade={"remove"}, orphanRemoval=true)
     * @ORM\JoinColumn(nullable=false)
     */
    private $article_categories;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;




    public function __construct()
    {
        $this->article_categories = new ArrayCollection();
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }


    /**
     * @ORM\PrePersist()
     */
    public function onPrepersist()
    {
        $this->created_at = new \DateTime();
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

    /**
     * @return Collection|ArticleCategorie[]
     */
    public function getArticleCategories(): Collection
    {
        return $this->article_categories;
    }

    public function addArticleCategory(ArticleCategorie $articleCategory): self
    {
        if (!$this->article_categories->contains($articleCategory)) {
            $this->article_categories[] = $articleCategory;
            $articleCategory->setArticles($this);
        }

        return $this;
    }

    public function removeArticleCategory(ArticleCategorie $articleCategory): self
    {
        if ($this->article_categories->contains($articleCategory)) {
            $this->article_categories->removeElement($articleCategory);
            // set the owning side to null (unless already changed)
            if ($articleCategory->getArticles() === $this) {
                $articleCategory->setArticles(null);
            }
        }

        return $this;
    }

    public function getCategories()
    {
        $return = [];
        foreach ($this->article_categories as $articleCategorie) {
            $return[] = $articleCategorie->getCategories();
        }
        
        return $return;
    }

  
}
