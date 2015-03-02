<?php

namespace Acme\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Acme\FrontendBundle\Entity\ArticleRepository")
 */
class Article
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
     * @ORM\Column(type="text", nullable=true)
     */
    protected $textContent;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $textSummary;
    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $strTitle;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $timeCreateTime;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $strThumb;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $intCategory;

    /**
     * @ORM\ManyToOne(targetEntity="ArticleCategory", inversedBy="articles")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $articleCategory;


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
     * Set articleCategory
     *
     * @param \Acme\FrontendBundle\Entity\ArticleCategory $articleCategory
     * @return Article
     */
    public function setArticleCategory(\Acme\FrontendBundle\Entity\ArticleCategory $articleCategory = null)
    {
        $this->articleCategory = $articleCategory;

        return $this;
    }

    /**
     * Get articleCategory
     *
     * @return \Acme\FrontendBundle\Entity\ArticleCategory 
     */
    public function getArticleCategory()
    {
        return $this->articleCategory;
    }

    /**
     * Set textContent
     *
     * @param string $textContent
     * @return Article
     */
    public function setTextContent($textContent)
    {
        $this->textContent = $textContent;

        return $this;
    }

    /**
     * Get textContent
     *
     * @return string 
     */
    public function getTextContent()
    {
        return $this->textContent;
    }

    /**
     * Set strTitle
     *
     * @param string $strTitle
     * @return Article
     */
    public function setStrTitle($strTitle)
    {
        $this->strTitle = $strTitle;

        return $this;
    }

    /**
     * Get strTitle
     *
     * @return string 
     */
    public function getStrTitle()
    {
        return $this->strTitle;
    }


    /**
     * Set strThumb
     *
     * @param string $strThumb
     * @return Article
     */
    public function setStrThumb($strThumb)
    {
        $this->strThumb = $strThumb;

        return $this;
    }

    /**
     * Get strThumb
     *
     * @return string 
     */
    public function getStrThumb()
    {
        return $this->strThumb;
    }

    /**
     * Set intCategory
     *
     * @param integer $intCategory
     * @return Article
     */
    public function setIntCategory($intCategory)
    {
        $this->intCategory = $intCategory;

        return $this;
    }

    /**
     * Get intCategory
     *
     * @return integer 
     */
    public function getIntCategory()
    {
        return $this->intCategory;
    }

    /**
     * Set timeCreateTime
     *
     * @param \DateTime $timeCreateTime
     * @return Article
     */
    public function setTimeCreateTime($timeCreateTime)
    {
        $this->timeCreateTime = $timeCreateTime;

        return $this;
    }

    /**
     * Get timeCreateTime
     *
     * @return \DateTime 
     */
    public function getTimeCreateTime()
    {
        return $this->timeCreateTime;
    }

    /**
     * Set textSummary
     *
     * @param string $textSummary
     * @return Article
     */
    public function setTextSummary($textSummary)
    {
        $this->textSummary = $textSummary;

        return $this;
    }

    /**
     * Get textSummary
     *
     * @return string 
     */
    public function getTextSummary()
    {
        return $this->textSummary;
    }
}
