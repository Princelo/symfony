<?php

namespace Acme\BackendBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Rank
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Acme\BackendBundle\Entity\RankRepository")
 * @UniqueEntity(
 *     fields={"intTermNo", "song"},
 *     message="System is busy, Please wait for a moment"
 * )
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
    protected $intZone;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $intIndex;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $intLastIndex;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $intCountOnList;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $intFMScore;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $intScore;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $boolIsPrePlus;

    /**
     * @ORM\ManyToOne(targetEntity="Song", inversedBy="ranks")
     * @ORM\JoinColumn(name="song_id", referencedColumnName="id")
     */
    protected $song;




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
     * Set intLastIndex
     *
     * @param integer $intLastIndex
     * @return Rank
     */
    public function setIntLastIndex($intLastIndex)
    {
        $this->intLastIndex = $intLastIndex;

        return $this;
    }

    /**
     * Get intLastIndex
     *
     * @return integer 
     */
    public function getIntLastIndex()
    {
        return $this->intLastIndex;
    }

    /**
     * Set intCountOnList
     *
     * @param integer $intCountOnList
     * @return Rank
     */
    public function setIntCountOnList($intCountOnList)
    {
        $this->intCountOnList = $intCountOnList;

        return $this;
    }

    /**
     * Get intCountOnList
     *
     * @return integer 
     */
    public function getIntCountOnList()
    {
        return $this->intCountOnList;
    }

    /**
     * Set song
     *
     * @param \Acme\BackendBundle\Entity\Song $song
     * @return Rank
     */
    public function setSong(\Acme\BackendBundle\Entity\Song $song = null)
    {
        $this->song = $song;

        return $this;
    }

    /**
     * Get song
     *
     * @return \Acme\BackendBundle\Entity\Song 
     */
    public function getSong()
    {
        return $this->song;
    }

    /**
     * Set intIndex
     *
     * @param integer $intIndex
     * @return Rank
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
     * Set intFMScore
     *
     * @param integer $intFMScore
     * @return Rank
     */
    public function setIntFMScore($intFMScore)
    {
        $this->intFMScore = $intFMScore;

        return $this;
    }

    /**
     * Get intFMScore
     *
     * @return integer 
     */
    public function getIntFMScore()
    {
        return $this->intFMScore;
    }

    /**
     * Set intScore
     *
     * @param integer $intScore
     * @return Rank
     */
    public function setIntScore($intScore)
    {
        $this->intScore = $intScore;

        return $this;
    }

    /**
     * Get intScore
     *
     * @return integer 
     */
    public function getIntScore()
    {
        return $this->intScore;
    }

    /**
     * Set boolIsPrePlus
     *
     * @param boolean $boolIsPrePlus
     * @return Rank
     */
    public function setBoolIsPrePlus($boolIsPrePlus)
    {
        $this->boolIsPrePlus = $boolIsPrePlus;

        return $this;
    }

    /**
     * Get boolIsPrePlus
     *
     * @return boolean 
     */
    public function getBoolIsPrePlus()
    {
        return $this->boolIsPrePlus;
    }
}
