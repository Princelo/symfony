<?php

namespace Acme\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Acme\BackendBundle\Entity\CommentRepository")
 */
class Comment
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
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $timeDateTime;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $strContent;
    /**
     * @ORM\ManyToOne(targetEntity="Song", inversedBy="comments")
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
     * Set intToUserId
     *
     * @param integer $intToUserId
     * @return Comment
     */
    public function setIntToUserId($intToUserId)
    {
        $this->intToUserId = $intToUserId;

        return $this;
    }

    /**
     * Get intToUserId
     *
     * @return integer 
     */
    public function getIntToUserId()
    {
        return $this->intToUserId;
    }

    /**
     * Set intDateTime
     *
     * @param integer $intDateTime
     * @return Comment
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
     * Set strContent
     *
     * @param string $strContent
     * @return Comment
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
     * Set intFromMemberId
     *
     * @param integer $intFromMemberId
     * @return Comment
     */
    public function setIntFromMemberId($intFromMemberId)
    {
        $this->intFromMemberId = $intFromMemberId;

        return $this;
    }

    /**
     * Get intFromMemberId
     *
     * @return integer 
     */
    public function getIntFromMemberId()
    {
        return $this->intFromMemberId;
    }

    /**
     * Set intToMemberId
     *
     * @param integer $intToMemberId
     * @return Comment
     */
    public function setIntToMemberId($intToMemberId)
    {
        $this->intToMemberId = $intToMemberId;

        return $this;
    }

    /**
     * Get intToMemberId
     *
     * @return integer 
     */
    public function getIntToMemberId()
    {
        return $this->intToMemberId;
    }

    /**
     * Set song
     *
     * @param \Acme\BackendBundle\Entity\Song $song
     * @return Comment
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
     * Set intMemberId
     *
     * @param integer $intMemberId
     * @return Comment
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
     * @return Comment
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
