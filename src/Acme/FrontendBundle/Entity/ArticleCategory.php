<?php

namespace Acme\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * ArticleCategory
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Acme\FrontendBundle\Entity\ArticleCategoryRepository")
 */
class ArticleCategory
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="strName", type="string", length=20)
     */
    private $strName;
    /**
     * @ORM\Column(name="strDisplayName", type="string", length=20)
     */
    private $strDisplayName;

    /**
     * @ORM\OneToMany(targetEntity="Article", mappedBy="articleCategory")
     */
    protected $articles;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Add articles
     *
     * @param \Acme\FrontendBundle\Entity\Article $articles
     * @return ArticleCategory
     */
    public function addArticle(\Acme\FrontendBundle\Entity\Article $articles)
    {
        $this->articles[] = $articles;

        return $this;
    }

    /**
     * Remove articles
     *
     * @param \Acme\FrontendBundle\Entity\Article $articles
     */
    public function removeArticle(\Acme\FrontendBundle\Entity\Article $articles)
    {
        $this->articles->removeElement($articles);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * Set strName
     *
     * @param string $strName
     * @return ArticleCategory
     */
    public function setStrName($strName)
    {
        $this->strName = $strName;

        return $this;
    }

    /**
     * Get strName
     *
     * @return string 
     */
    public function getStrName()
    {
        return $this->strName;
    }

    /**
     * Set strDisplayName
     *
     * @param string $strDisplayName
     * @return ArticleCategory
     */
    public function setStrDisplayName($strDisplayName)
    {
        $this->strDisplayName = $strDisplayName;

        return $this;
    }

    /**
     * Get strDisplayName
     *
     * @return string 
     */
    public function getStrDisplayName()
    {
        return $this->strDisplayName;
    }
}
