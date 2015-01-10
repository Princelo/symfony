<?php

namespace Acme\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Forecast
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Acme\BackendBundle\Entity\ForecastRepository")
 */
class Forecast
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
    protected $intMemberId;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="请填写內容")
     */
    protected $strContent;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $timeDateTime;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $boolIsUp;


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
     * Set strContent
     *
     * @param string $strContent
     * @return Forecast
     */
    public function setStrContent($strContent)
    {
        $this->strContent = $strContent;

        return $this;
    }

    /**
     * Get strContent
     *
     * @return string 
     */
    public function getStrContent()
    {
        return $this->strContent;
    }


    /**
     * Set intMemberId
     *
     * @param integer $intMemberId
     * @return Forecast
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


    /**
     * Set timeDateTime
     *
     * @param \DateTime $timeDateTime
     * @return Forecast
     */
    public function setTimeDateTime($timeDateTime)
    {
        $this->timeDateTime = $timeDateTime;

        return $this;
    }

    /**
     * Get timeDateTime
     *
     * @return \DateTime 
     */
    public function getTimeDateTime()
    {
        return $this->timeDateTime;
    }

    /**
     * Set boolIsUp
     *
     * @param boolean $boolIsUp
     * @return Forecast
     */
    public function setBoolIsUp($boolIsUp)
    {
        $this->boolIsUp = $boolIsUp;

        return $this;
    }

    /**
     * Get boolIsUp
     *
     * @return boolean 
     */
    public function getBoolIsUp()
    {
        return $this->boolIsUp;
    }
}
