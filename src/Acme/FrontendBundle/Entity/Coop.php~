<?php

namespace Acme\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Coop
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Acme\FrontendBundle\Entity\CoopRepository")
 */
class Coop
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
    protected $strThumb;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $strTitle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $strLink;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $timeUploadTime;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $intWeight;


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
     * Set strThumb
     *
     * @param string $strThumb
     * @return Coop
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
     * Set strTitle
     *
     * @param string $strTitle
     * @return Coop
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
     * Set strLink
     *
     * @param string $strLink
     * @return Coop
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
     * Set timeUploadTime
     *
     * @param \DateTime $timeUploadTime
     * @return Coop
     */
    public function setTimeUploadTime($timeUploadTime)
    {
        $this->timeUploadTime = $timeUploadTime;

        return $this;
    }

    /**
     * Get timeUploadTime
     *
     * @return \DateTime 
     */
    public function getTimeUploadTime()
    {
        return $this->timeUploadTime;
    }

    /**
     * Set intWeight
     *
     * @param integer $intWeight
     * @return Coop
     */
    public function setIntWeight($intWeight)
    {
        $this->intWeight = $intWeight;

        return $this;
    }

    /**
     * Get intWeight
     *
     * @return integer 
     */
    public function getIntWeight()
    {
        return $this->intWeight;
    }
}
