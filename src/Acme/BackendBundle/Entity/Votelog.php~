<?php

namespace Acme\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Votelog
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Acme\BackendBundle\Entity\VotelogRepository")
 */
class Votelog
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
    protected $intSongId;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $intMemberId;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $intTermNo;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $timeVoteDateTime;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $intIndex;

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
     * Set intSongId
     *
     * @param integer $intSongId
     * @return Votelog
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
     * Set intTermNo
     *
     * @param integer $intTermNo
     * @return Votelog
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
     * @return Votelog
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
     * Set intIndex
     *
     * @param integer $intIndex
     * @return Votelog
     */
    public function setIntIndex($intIndex)
    {
        $this->intIndex = $intIndex;

        return $this;
    }

    /**
     * Get intIndex
     *
     * @return integer 
     */
    public function getIntIndex()
    {
        return $this->intIndex;
    }

    /**
     * Set intZone
     *
     * @param integer $intZone
     * @return Votelog
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

    public function createAt()
    {
        $this->setTimeVoteDateTime(new \DateTime());
    }

    /**
     * Set timeVoteDateTime
     *
     * @param \DateTime $timeVoteDateTime
     * @return Votelog
     */
    public function setTimeVoteDateTime($timeVoteDateTime)
    {
        $this->timeVoteDateTime = $timeVoteDateTime;

        return $this;
    }

    /**
     * Get timeVoteDateTime
     *
     * @return \DateTime 
     */
    public function getTimeVoteDateTime()
    {
        return $this->timeVoteDateTime;
    }
}
