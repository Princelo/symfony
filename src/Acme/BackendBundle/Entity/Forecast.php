<?php

namespace Acme\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type="integer")
     */
    protected $intMemberId;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $strContent;
    /**
     * @ORM\Column(type="integer")
     */
    protected $intDateTime;


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
     * Set intDateTime
     *
     * @param integer $intDateTime
     * @return Forecast
     */
    public function setIntDateTime($intDateTime)
    {
        $this->intDateTime = $intDateTime;

        return $this;
    }

    /**
     * Get intDateTime
     *
     * @return integer 
     */
    public function getIntDateTime()
    {
        return $this->intDateTime;
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
}
