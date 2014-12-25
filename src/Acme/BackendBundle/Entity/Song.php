<?php

namespace Acme\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Song
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Acme\BackendBundle\Entity\SongRepository")
 */
class Song
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
     * @ORM\Column(type="string", length=50)
     */
    protected $strTitle;
    /**
     * @ORM\Column(type="array")
     */
    protected $arrStrArtist;
    /**
     * @ORM\Column(type="integer")
     */
    protected $intMemberId;
    /**
     * @ORM\Column(type="integer")
     */
    protected $intSpecialId;
    /**
     * @ORM\Column(type="string", length=30)
     */
    protected $strLyricist;
    /**
     * @ORM\Column(type="string", length=30)
     */
    protected $strComposer;
    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $strCorpName;
    /**
     * @ORM\Column(type="boolean")
     */
    protected $boolIsRank;
    /**
     * @ORM\Column(type="integer")
     */
    protected $intRankZone;
    /**
     * @ORM\Column(type="boolean")
     */
    protected $boolIsPremiere;
    /**
     * @ORM\Column(type="boolean")
     */
    protected $boolIsMain;
    /**
     * @ORM\Column(type="integer")
     */
    protected $intCategory;
    /**
     * @ORM\Column(type="integer")
     */
    protected $intStyle;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $strPromotionFile;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $strCoverFile;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $strLyricFile;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $strSongFile;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $strAuthFile;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $strOtherLink1;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $strOtherLink2;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $strOtherLink3;
    /**
     * @ORM\Column(type="string", length=10)
     */
    protected $strRankTimeFrom;
    /**
     * @ORM\Column(type="string", length=10)
     */
    protected $strRankTimeTo;
    /**
     * @ORM\Column(type="integer")
     */
    protected $intPRCResult;
    /**
     * @ORM\Column(type="integer")
     */
    protected $intHKTWResult;
    /**
     * @ORM\Column(type="integer")
     */
    protected $intPlayTimes;
    /**
     * @ORM\Column(type="integer")
     */
    protected $intUploadDateTime;
    /**
     * @ORM\ManyToOne(targetEntity="Special", inversedBy="songs")
     * @ORM\JoinColumn(name="special_id", referencedColumnName="id")
     */
    protected $special;

    /**
     * @ORM\ManyToMany(targetEntity="Rank", inversedBy="songs")
     */
    protected $ranks;

    public function __construct()
    {
        $this->ranks = new ArrayCollection();
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
     * Set strTitle
     *
     * @param string $strTitle
     * @return Song
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
     * Set arrStrArtist
     *
     * @param array $arrStrArtist
     * @return Song
     */
    public function setArrStrArtist($arrStrArtist)
    {
        $this->arrStrArtist = $arrStrArtist;

        return $this;
    }

    /**
     * Get arrStrArtist
     *
     * @return array 
     */
    public function getArrStrArtist()
    {
        return $this->arrStrArtist;
    }


    /**
     * Set intSpecialId
     *
     * @param integer $intSpecialId
     * @return Song
     */
    public function setIntSpecialId($intSpecialId)
    {
        $this->intSpecialId = $intSpecialId;

        return $this;
    }

    /**
     * Get intSpecialId
     *
     * @return integer 
     */
    public function getIntSpecialId()
    {
        return $this->intSpecialId;
    }

    /**
     * Set strLyricist
     *
     * @param string $strLyricist
     * @return Song
     */
    public function setStrLyricist($strLyricist)
    {
        $this->strLyricist = $strLyricist;

        return $this;
    }

    /**
     * Get strLyricist
     *
     * @return string 
     */
    public function getStrLyricist()
    {
        return $this->strLyricist;
    }

    /**
     * Set strComposer
     *
     * @param string $strComposer
     * @return Song
     */
    public function setStrComposer($strComposer)
    {
        $this->strComposer = $strComposer;

        return $this;
    }

    /**
     * Get strComposer
     *
     * @return string 
     */
    public function getStrComposer()
    {
        return $this->strComposer;
    }

    /**
     * Set strCorpName
     *
     * @param string $strCorpName
     * @return Song
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
     * Set boolIsRank
     *
     * @param boolean $boolIsRank
     * @return Song
     */
    public function setBoolIsRank($boolIsRank)
    {
        $this->boolIsRank = $boolIsRank;

        return $this;
    }

    /**
     * Get boolIsRank
     *
     * @return boolean 
     */
    public function getBoolIsRank()
    {
        return $this->boolIsRank;
    }

    /**
     * Set intRankZone
     *
     * @param integer $intRankZone
     * @return Song
     */
    public function setIntRankZone($intRankZone)
    {
        $this->intRankZone = $intRankZone;

        return $this;
    }

    /**
     * Get intRankZone
     *
     * @return integer 
     */
    public function getIntRankZone()
    {
        return $this->intRankZone;
    }

    /**
     * Set boolIsPremiere
     *
     * @param boolean $boolIsPremiere
     * @return Song
     */
    public function setBoolIsPremiere($boolIsPremiere)
    {
        $this->boolIsPremiere = $boolIsPremiere;

        return $this;
    }

    /**
     * Get boolIsPremiere
     *
     * @return boolean 
     */
    public function getBoolIsPremiere()
    {
        return $this->boolIsPremiere;
    }

    /**
     * Set boolIsMain
     *
     * @param boolean $boolIsMain
     * @return Song
     */
    public function setBoolIsMain($boolIsMain)
    {
        $this->boolIsMain = $boolIsMain;

        return $this;
    }

    /**
     * Get boolIsMain
     *
     * @return boolean 
     */
    public function getBoolIsMain()
    {
        return $this->boolIsMain;
    }

    /**
     * Set intCategory
     *
     * @param integer $intCategory
     * @return Song
     */
    public function setIntCategory($intCategory)
    {
        $this->intCategory = $intCategory;

        return $this;
    }

    /**
     * Get intCategory
     *
     * @return integer 
     */
    public function getIntCategory()
    {
        return $this->intCategory;
    }

    /**
     * Set intStyle
     *
     * @param integer $intStyle
     * @return Song
     */
    public function setIntStyle($intStyle)
    {
        $this->intStyle = $intStyle;

        return $this;
    }

    /**
     * Get intStyle
     *
     * @return integer 
     */
    public function getIntStyle()
    {
        return $this->intStyle;
    }

    /**
     * Set strPromotionFile
     *
     * @param string $strPromotionFile
     * @return Song
     */
    public function setStrPromotionFile($strPromotionFile)
    {
        $this->strPromotionFile = $strPromotionFile;

        return $this;
    }

    /**
     * Get strPromotionFile
     *
     * @return string 
     */
    public function getStrPromotionFile()
    {
        return $this->strPromotionFile;
    }

    /**
     * Set strCoverFile
     *
     * @param string $strCoverFile
     * @return Song
     */
    public function setStrCoverFile($strCoverFile)
    {
        $this->strCoverFile = $strCoverFile;

        return $this;
    }

    /**
     * Get strCoverFile
     *
     * @return string 
     */
    public function getStrCoverFile()
    {
        return $this->strCoverFile;
    }

    /**
     * Set strLyricFile
     *
     * @param string $strLyricFile
     * @return Song
     */
    public function setStrLyricFile($strLyricFile)
    {
        $this->strLyricFile = $strLyricFile;

        return $this;
    }

    /**
     * Get strLyricFile
     *
     * @return string 
     */
    public function getStrLyricFile()
    {
        return $this->strLyricFile;
    }

    /**
     * Set strSongFile
     *
     * @param string $strSongFile
     * @return Song
     */
    public function setStrSongFile($strSongFile)
    {
        $this->strSongFile = $strSongFile;

        return $this;
    }

    /**
     * Get strSongFile
     *
     * @return string 
     */
    public function getStrSongFile()
    {
        return $this->strSongFile;
    }

    /**
     * Set strAuthFile
     *
     * @param string $strAuthFile
     * @return Song
     */
    public function setStrAuthFile($strAuthFile)
    {
        $this->strAuthFile = $strAuthFile;

        return $this;
    }

    /**
     * Get strAuthFile
     *
     * @return string 
     */
    public function getStrAuthFile()
    {
        return $this->strAuthFile;
    }

    /**
     * Set strOtherLink1
     *
     * @param string $strOtherLink1
     * @return Song
     */
    public function setStrOtherLink1($strOtherLink1)
    {
        $this->strOtherLink1 = $strOtherLink1;

        return $this;
    }

    /**
     * Get strOtherLink1
     *
     * @return string 
     */
    public function getStrOtherLink1()
    {
        return $this->strOtherLink1;
    }

    /**
     * Set strOtherLink2
     *
     * @param string $strOtherLink2
     * @return Song
     */
    public function setStrOtherLink2($strOtherLink2)
    {
        $this->strOtherLink2 = $strOtherLink2;

        return $this;
    }

    /**
     * Get strOtherLink2
     *
     * @return string 
     */
    public function getStrOtherLink2()
    {
        return $this->strOtherLink2;
    }

    /**
     * Set strOtherLink3
     *
     * @param string $strOtherLink3
     * @return Song
     */
    public function setStrOtherLink3($strOtherLink3)
    {
        $this->strOtherLink3 = $strOtherLink3;

        return $this;
    }

    /**
     * Get strOtherLink3
     *
     * @return string 
     */
    public function getStrOtherLink3()
    {
        return $this->strOtherLink3;
    }

    /**
     * Set strRankTimeFrom
     *
     * @param string $strRankTimeFrom
     * @return Song
     */
    public function setStrRankTimeFrom($strRankTimeFrom)
    {
        $this->strRankTimeFrom = $strRankTimeFrom;

        return $this;
    }

    /**
     * Get strRankTimeFrom
     *
     * @return string 
     */
    public function getStrRankTimeFrom()
    {
        return $this->strRankTimeFrom;
    }

    /**
     * Set strRankTimeTo
     *
     * @param string $strRankTimeTo
     * @return Song
     */
    public function setStrRankTimeTo($strRankTimeTo)
    {
        $this->strRankTimeTo = $strRankTimeTo;

        return $this;
    }

    /**
     * Get strRankTimeTo
     *
     * @return string 
     */
    public function getStrRankTimeTo()
    {
        return $this->strRankTimeTo;
    }

    /**
     * Set intPRCResult
     *
     * @param integer $intPRCResult
     * @return Song
     */
    public function setIntPRCResult($intPRCResult)
    {
        $this->intPRCResult = $intPRCResult;

        return $this;
    }

    /**
     * Get intPRCResult
     *
     * @return integer 
     */
    public function getIntPRCResult()
    {
        return $this->intPRCResult;
    }

    /**
     * Set intHKTWResult
     *
     * @param integer $intHKTWResult
     * @return Song
     */
    public function setIntHKTWResult($intHKTWResult)
    {
        $this->intHKTWResult = $intHKTWResult;

        return $this;
    }

    /**
     * Get intHKTWResult
     *
     * @return integer 
     */
    public function getIntHKTWResult()
    {
        return $this->intHKTWResult;
    }

    /**
     * Set intPlayTimes
     *
     * @param integer $intPlayTimes
     * @return Song
     */
    public function setIntPlayTimes($intPlayTimes)
    {
        $this->intPlayTimes = $intPlayTimes;

        return $this;
    }

    /**
     * Get intPlayTimes
     *
     * @return integer 
     */
    public function getIntPlayTimes()
    {
        return $this->intPlayTimes;
    }

    /**
     * Set intUploadDateTime
     *
     * @param integer $intUploadDateTime
     * @return Song
     */
    public function setIntUploadDateTime($intUploadDateTime)
    {
        $this->intUploadDateTime = $intUploadDateTime;

        return $this;
    }

    /**
     * Get intUploadDateTime
     *
     * @return integer 
     */
    public function getIntUploadDateTime()
    {
        return $this->intUploadDateTime;
    }

    /**
     * Set special
     *
     * @param \Acme\BackendBundle\Entity\Special $special
     * @return Song
     */
    public function setSpecial(\Acme\BackendBundle\Entity\Special $special = null)
    {
        $this->special = $special;

        return $this;
    }

    /**
     * Get special
     *
     * @return \Acme\BackendBundle\Entity\Special 
     */
    public function getSpecial()
    {
        return $this->special;
    }

    /**
     * Set intMemberId
     *
     * @param integer $intMemberId
     * @return Song
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
     * Add ranks
     *
     * @param \Acme\BackendBundle\Entity\Rank $ranks
     * @return Song
     */
    public function addRank(\Acme\BackendBundle\Entity\Rank $ranks)
    {
        $this->ranks[] = $ranks;

        return $this;
    }

    /**
     * Remove ranks
     *
     * @param \Acme\BackendBundle\Entity\Rank $ranks
     */
    public function removeRank(\Acme\BackendBundle\Entity\Rank $ranks)
    {
        $this->ranks->removeElement($ranks);
    }

    /**
     * Get ranks
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRanks()
    {
        return $this->ranks;
    }
}
