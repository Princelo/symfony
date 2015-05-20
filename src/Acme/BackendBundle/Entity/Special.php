<?php

namespace Acme\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Special
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Acme\BackendBundle\Entity\SpecialRepository")
 */
class Special
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
     * @ORM\OneToMany(targetEntity="Song", mappedBy="special")
     */
    protected $songs;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $strTitle;
    /**
     * @ORM\Column(type="array")
     */
    protected $arrStrArtistName;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $strReleaseDate;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $strCorpName;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $strIntro;
    /**
     * @ORM\Column(type="integer")
     */
    protected $intMemberId;
    /**
     * @ORM\Column(type="integer")
     */
    protected $intCreateDateTime;


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
     * Constructor
     */
    public function __construct()
    {
        $this->songs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set strTitle
     *
     * @param string $strTitle
     * @return Special
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
     * Set arrStrArtistName
     *
     * @param array $arrStrArtistName
     * @return Special
     */
    public function setArrStrArtistName($arrStrArtistName)
    {
        $this->arrStrArtistName = $arrStrArtistName;

        return $this;
    }

    /**
     * Get arrStrArtistName
     *
     * @return array 
     */
    public function getArrStrArtistName()
    {
        return $this->arrStrArtistName;
    }

    /**
     * Set strReleaseDate
     *
     * @param string $strReleaseDate
     * @return Special
     */
    public function setStrReleaseDate($strReleaseDate)
    {
        $this->strReleaseDate = $strReleaseDate;

        return $this;
    }

    /**
     * Get strReleaseDate
     *
     * @return string 
     */
    public function getStrReleaseDate()
    {
        return $this->strReleaseDate;
    }

    /**
     * Set strCorpName
     *
     * @param string $strCorpName
     * @return Special
     */
    public function setStrCorpName($strCorpName)
    {
        $this->strCorpName = $strCorpName;

        return $this;
    }

    /**
     * Get strCorpName
     *
     * @return string 
     */
    public function getStrCorpName()
    {
        return $this->strCorpName;
    }

    /**
     * Set strIntro
     *
     * @param string $strIntro
     * @return Special
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
     * Set intCreateDateTime
     *
     * @param integer $intCreateDateTime
     * @return Special
     */
    public function setIntCreateDateTime($intCreateDateTime)
    {
        $this->intCreateDateTime = $intCreateDateTime;

        return $this;
    }

    /**
     * Get intCreateDateTime
     *
     * @return integer 
     */
    public function getIntCreateDateTime()
    {
        return $this->intCreateDateTime;
    }

    /**
     * Add songs
     *
     * @param \Acme\BackendBundle\Entity\Song $songs
     * @return Special
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
     * Get songs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSongs()
    {
        return $this->songs;
    }

    /**
     * Set intMemberId
     *
     * @param integer $intMemberId
     * @return Special
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
