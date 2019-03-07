<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;
/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity("name",message="Cette catégorie existe déjà.")
 */
class Categorie
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
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ArticleCategorie", mappedBy="categories", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie_articles;

    public function __construct()
    {
        $this->categorie_articles = new ArrayCollection();
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

    /**
     * @ORM\PrePersist()
     */
    public function onPrepersist()
    {
        $this->created_at = new \DateTime();
        return $this;
    }


    public function __toString()
    {
     return $this->name;
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
     * @return Collection|ArticleCategorie[]
     */
    public function getCategorieArticles(): Collection
    {
        return $this->categorie_articles;
    }

    public function addCategorieArticle(ArticleCategorie $categorieArticle): self
    {
        if (!$this->categorie_articles->contains($categorieArticle)) {
            $this->categorie_articles[] = $categorieArticle;
            $categorieArticle->setCategories($this);
        }

        return $this;
    }

    public function removeCategorieArticle(ArticleCategorie $categorieArticle): self
    {
        if ($this->categorie_articles->contains($categorieArticle)) {
            $this->categorie_articles->removeElement($categorieArticle);
            // set the owning side to null (unless already changed)
            if ($categorieArticle->getCategories() === $this) {
                $categorieArticle->setCategories(null);
            }
        }

        return $this;
    }

}
