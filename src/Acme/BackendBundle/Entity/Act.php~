<?php

namespace Acme\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Act
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Acme\BackendBundle\Entity\ActRepository")
 */
class Act
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
     * @ORM\Column(type="integer")
     */
    protected $intType;
    /**
     * @ORM\Column(type="integer")
     */
    protected $intMemberId;
    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $strTitle;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $strIntro;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $strOtherLink;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $strActFile;
    /**
     * @ORM\Column(type="integer")
     */
    protected $intUploadDateTime;


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
     * Set intType
     *
     * @param integer $intType
     * @return Act
     */
    public function setIntType($intType)
    {
        $this->intType = $intType;

        return $this;
    }

    /**
     * Get intType
     *
     * @return integer 
     */
    public function getIntType()
    {
        return $this->intType;
    }


    /**
     * Set strTitle
     *
     * @param string $strTitle
     * @return Act
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
     * Set strIntro
     *
     * @param string $strIntro
     * @return Act
     */
    public function setStrIntro($strIntro)
    {
        $this->strIntro = $strIntro;

        return $this;
    }

    /**
     * Get strIntro
     *
     * @return string 
     */
    public function getStrIntro()
    {
        return $this->strIntro;
    }

    /**
     * Set strOtherLink
     *
     * @param string $strOtherLink
     * @return Act
     */
    public function setStrOtherLink($strOtherLink)
    {
        $this->strOtherLink = $strOtherLink;

        return $this;
    }

    /**
     * Get strOtherLink
     *
     * @return string 
     */
    public function getStrOtherLink()
    {
        return $this->strOtherLink;
    }

    /**
     * Set strActFile
     *
     * @param string $strActFile
     * @return Act
     */
    public function setStrActFile($strActFile)
    {
        $this->strActFile = $strActFile;

        return $this;
    }

    /**
     * Get strActFile
     *
     * @return string 
     */
    public function getStrActFile()
    {
        return $this->strActFile;
    }

    /**
     * Set intUploadDateTime
     *
     * @param integer $intUploadDateTime
     * @return Act
     */
    public function setIntUploadDateTime($intUploadDateTime)
    {
        $this->intUploadDateTime = $intUploadDateTime;

        return $this;
    }

    /**
     * Get intUploadDateTime
     *
     * @return integer 
     */
    public function getIntUploadDateTime()
    {
        return $this->intUploadDateTime;
    }

    /**
     * Set intMemberId
     *
     * @param integer $intMemberId
     * @return Act
     */
    public function setIntMemberId($intMemberId)
    {
        $this->intMemberId = $intMemberId;

        return $this;
    }

    /**
     * Get intMemberId
     *
     * @return integer 
     */
    public function getIntMemberId()
    {
        return $this->intMemberId;
    }
}
