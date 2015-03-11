<?php

namespace Acme\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Flash
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Acme\FrontendBundle\Entity\FlashRepository")
 */
class Flash
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $strLink;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $strImg;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $boolIsNewTab;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $intCategory;


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
     * Set strLink
     *
     * @param string $strLink
     * @return Flash
     */
    public function setStrLink($strLink)
    {
        $this->strLink = $strLink;

        return $this;
    }

    /**
     * Get strLink
     *
     * @return string 
     */
    public function getStrLink()
    {
        return $this->strLink;
    }

    /**
     * Set strImg
     *
     * @param string $strImg
     * @return Flash
     */
    public function setStrImg($strImg)
    {
        $this->strImg = $strImg;

        return $this;
    }

    /**
     * Get strImg
     *
     * @return string 
     */
    public function getStrImg()
    {
        return $this->strImg;
    }

    /**
     * Set boolIsNewTab
     *
     * @param boolean $boolIsNewTab
     * @return Flash
     */
    public function setBoolIsNewTab($boolIsNewTab)
    {
        $this->boolIsNewTab = $boolIsNewTab;

        return $this;
    }

    /**
     * Get boolIsNewTab
     *
     * @return boolean 
     */
    public function getBoolIsNewTab()
    {
        return $this->boolIsNewTab;
    }

    /**
     * Set intCategory
     *
     * @param integer $intCategory
     * @return Flash
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
}
