<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
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
    private $designation;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CategorieArticle", mappedBy="Article")
     */
    private $categorieArticles;

    public function __construct()
    {
        $this->categorieArticles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * @return Collection|CategorieArticle[]
     */
    public function getCategorieArticles(): Collection
    {
        return $this->categorieArticles;
    }

    public function addCategorieArticle(CategorieArticle $categorieArticle): self
    {
        if (!$this->categorieArticles->contains($categorieArticle)) {
            $this->categorieArticles[] = $categorieArticle;
            $categorieArticle->setArticle($this);
        }

        return $this;
    }

    public function removeCategorieArticle(CategorieArticle $categorieArticle): self
    {
        if ($this->categorieArticles->contains($categorieArticle)) {
            $this->categorieArticles->removeElement($categorieArticle);
            // set the owning side to null (unless already changed)
            if ($categorieArticle->getArticle() === $this) {
                $categorieArticle->setArticle(null);
            }
        }

        return $this;
    }
}
