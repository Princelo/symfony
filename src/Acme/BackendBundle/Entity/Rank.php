<?php

namespace Acme\BackendBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Rank
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Acme\BackendBundle\Entity\RankRepository")
 */
class Rank
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
    protected $intType;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $intZone;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $intMemberId;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $timeCreateTime;

    /**
     * @ORM\ManyToMany(targetEntity="Song", inversedBy="ranks")
     */
    protected $songs;

    public function __construct()
    {
        $this->songs = new ArrayCollection();
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
     * Set intTermNo
     *
     * @param integer $intTermNo
     * @return Rank
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
     * Set intType
     *
     * @param integer $intType
     * @return Rank
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
     * Set intZone
     *
     * @param integer $intZone
     * @return Rank
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
     * Set intMemberId
     *
     * @param integer $intMemberId
     * @return Rank
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
     * Set songs
     *
     * @param integer $songs
     * @return Rank
     */
    public function setSongs($songs)
    {
        $this->songs = $songs;

        return $this;
    }

    /**
     * Get songs
     *
     * @return integer 
     */
    public function getSongs()
    {
        return $this->songs;
    }


    /**
     * Add songs
     *
     * @param \Acme\BackendBundle\Entity\Song $songs
     * @return Rank
     */
    public function addSong(\Acme\BackendBundle\Entity\Song $songs)
    {
        $this->songs[] = $songs;

        return $this;
    }

    /**
     * Remove songs
     *
     * @param \Acme\BackendBundle\Entity\Song $songs
     */
    public function removeSong(\Acme\BackendBundle\Entity\Song $songs)
    {
        $this->songs->removeElement($songs);
    }

    /**
     * Set timeCreateTime
     *
     * @param \DateTime $timeCreateTime
     * @return Rank
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
}
