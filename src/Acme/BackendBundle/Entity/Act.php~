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
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $intType;
    /**
     * @ORM\ManyToOne(targetEntity="Member", inversedBy="acts")
     * @ORM\JoinColumn(name="member_id", referencedColumnName="id")
     */
    protected $member;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $strTitle;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $strIntro;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $strOtherLink;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $strActFile;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $timeUploadDateTime;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $intFileType;//1 for link, 2 for file


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
     * Set timeUploadDateTime
     *
     * @param \DateTime $timeUploadDateTime
     * @return Act
     */
    public function setTimeUploadDateTime($timeUploadDateTime)
    {
        $this->timeUploadDateTime = $timeUploadDateTime;

        return $this;
    }

    /**
     * Get timeUploadDateTime
     *
     * @return \DateTime 
     */
    public function getTimeUploadDateTime()
    {
        return $this->timeUploadDateTime;
    }

    /**
     * Set intFileType
     *
     * @param integer $intFileType
     * @return Act
     */
    public function setIntFileType($intFileType)
    {
        $this->intFileType = $intFileType;

        return $this;
    }

    /**
     * Get intFileType
     *
     * @return integer 
     */
    public function getIntFileType()
    {
        return $this->intFileType;
    }

    /**
     * Set member
     *
     * @param \Acme\BackendBundle\Entity\Member $member
     * @return Act
     */
    public function setMember(\Acme\BackendBundle\Entity\Member $member = null)
    {
        $this->member = $member;

        return $this;
    }

    /**
     * Get member
     *
     * @return \Acme\BackendBundle\Entity\Member 
     */
    public function getMember()
    {
        return $this->member;
    }
}
