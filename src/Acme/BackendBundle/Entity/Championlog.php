<?php

namespace Acme\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Championlog
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Acme\BackendBundle\Entity\ChampionlogRepository")
 */
class Championlog
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
    protected $intTermNo;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $intMemberId;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $intSongId;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $timeDateTime;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $intZone;


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
     * Set intTermNo
     *
     * @param integer $intTermNo
     * @return Championlog
     */
    public function setIntTermNo($intTermNo)
    {
        $this->intTermNo = $intTermNo;

        return $this;
    }

    /**
     * Get intTermNo
     *
     * @return integer 
     */
    public function getIntTermNo()
    {
        return $this->intTermNo;
    }



    /**
     * Set intMemberId
     *
     * @param integer $intMemberId
     * @return Championlog
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
     * Set intSongId
     *
     * @param integer $intSongId
     * @return Championlog
     */
    public function setIntSongId($intSongId)
    {
        $this->intSongId = $intSongId;

        return $this;
    }

    /**
     * Get intSongId
     *
     * @return integer 
     */
    public function getIntSongId()
    {
        return $this->intSongId;
    }

    /**
     * Set intZone
     *
     * @param integer $intZone
     * @return Championlog
     */
    public function setIntZone($intZone)
    {
        $this->intZone = $intZone;

        return $this;
    }

    /**
     * Get intZone
     *
     * @return integer 
     */
    public function getIntZone()
    {
        return $this->intZone;
    }

    /**
     * Set timeDateTime
     *
     * @param \DateTime $timeDateTime
     * @return Championlog
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
}
