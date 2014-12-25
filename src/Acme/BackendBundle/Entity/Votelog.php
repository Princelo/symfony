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
     * @ORM\Column(type="integer")
     */
    protected $intSongId;
    /**
     * @ORM\Column(type="integer")
     */
    protected $intMemberId;
    /**
     * @ORM\Column(type="integer")
     */
    protected $intTermId;
    /**
     * @ORM\Column(type="integer")
     */
    protected $intRank;
    /**
     * @ORM\Column(type="integer")
     */
    protected $intVoteDateTime;


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
     * Set intTermId
     *
     * @param integer $intTermId
     * @return Votelog
     */
    public function setIntTermId($intTermId)
    {
        $this->intTermId = $intTermId;

        return $this;
    }

    /**
     * Get intTermId
     *
     * @return integer 
     */
    public function getIntTermId()
    {
        return $this->intTermId;
    }

    /**
     * Set intRank
     *
     * @param integer $intRank
     * @return Votelog
     */
    public function setIntRank($intRank)
    {
        $this->intRank = $intRank;

        return $this;
    }

    /**
     * Get intRank
     *
     * @return integer 
     */
    public function getIntRank()
    {
        return $this->intRank;
    }

    /**
     * Set intVoteDateTime
     *
     * @param integer $intVoteDateTime
     * @return Votelog
     */
    public function setIntVoteDateTime($intVoteDateTime)
    {
        $this->intVoteDateTime = $intVoteDateTime;

        return $this;
    }

    /**
     * Get intVoteDateTime
     *
     * @return integer 
     */
    public function getIntVoteDateTime()
    {
        return $this->intVoteDateTime;
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
}
