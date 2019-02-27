<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
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
    private $categorie;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CategorieArticle", mappedBy="Categorie")
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

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

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
            $categorieArticle->setCategorie($this);
        }

        return $this;
    }

    public function removeCategorieArticle(CategorieArticle $categorieArticle): self
    {
        if ($this->categorieArticles->contains($categorieArticle)) {
            $this->categorieArticles->removeElement($categorieArticle);
            // set the owning side to null (unless already changed)
            if ($categorieArticle->getCategorie() === $this) {
                $categorieArticle->setCategorie(null);
            }
        }

        return $this;
    }
}
