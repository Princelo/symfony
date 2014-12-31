<?php

namespace Acme\BackendBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Acme\BackendBundle\Entity\Constant;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Member
 *
 * @ORM\Entity(repositoryClass="Acme\BackendBundle\Entity\MemberRepository")
 * @UniqueEntity("email")
 */
class Member implements AdvancedUserInterface, \Serializable
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
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=64)
     * @Assert\NotBlank(groups={"admin_registration_step_one"})
     * @Assert\Length(min = 8, max = 4096)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     * @Assert\NotBlank(message="請填寫郵箱帳號.", groups={"admin_registration_step_one"})
     * @Assert\Email(message="請正確填寫郵箱格式")
     */
    private $email;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $intStatus;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $boolIsAcceptAuth = false;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $intType;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $strLogo;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $strAvatar;
    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(groups={"admin_registration_step_two"})
     */
    protected $strFullName;
    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\NotBlank(groups={"admin_registration_step_two"})
     */
    protected $strShortName;
    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotBlank(groups={"admin_registration_step_two"})
     */
    protected $intProvinceId;
    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotBlank(groups={"admin_registration_step_two"})
     */
    protected $intCityId;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(groups={"admin_registration_step_two"})
     */
    protected $strAddressInfo;
    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    protected $strZipCode;
    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Assert\NotBlank(groups={"admin_registration_step_two"})
     */
    protected $strTel;
    /**
     * @ORM\Column(type="array", nullable=true, nullable=true)
     */
    protected $arrStrArtistName;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $strIntro;
    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    protected $strUserName;
    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    protected $strUserNickName;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $intUserGender;
    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    protected $strUserCitizenId;
    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $strUserMobile;
    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $strUserTel;
    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $strUserQQ;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $timeLastLoginTime;
    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $strSite;
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $boolIsValid;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $timeCreateTime;
    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $strEMail;
    /**
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    protected $strPassword;
    //FM only
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $intLevel;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $intFMType;
    /**
     * @ORM\Column(type="decimal", scale=2, nullable=true)
     */
    protected $floatFMValue;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $intFMValueType;
    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $strFMFactor;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $strFMFoundTime;
    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $strFMCoverPopular;
    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $strFMJoinAct;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $intCastWeekDay;
    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    protected $strCastTimeFrom;
    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    protected $strCastTimeTo;
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $boolCastTimeToTomorrow;
    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $strSeniority;
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $boolIsOneCoop;
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $boolIsOneRank;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $intCastType;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $intBusyWeekDayFrom1;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $intBusyWeekDayFrom2;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $intBusyWeekDayFrom3;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $intBusyWeekDayFrom4;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $intBusyWeekDayFrom5;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $intBusyWeekDayTo1;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $intBusyWeekDayTo2;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $intBusyWeekDayTo3;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $intBusyWeekDayTo4;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $intBusyWeekDayTo5;
    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    protected $strBusyTimeFrom1;
    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    protected $strBusyTimeFrom2;
    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    protected $strBusyTimeFrom3;
    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    protected $strBusyTimeFrom4;
    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    protected $strBusyTimeFrom5;
    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    protected $strBusyTimeTo1;
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $boolBusyTimeTo1Tomorrow;
    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    protected $strBusyTimeTo2;
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $boolBusyTimeTo2Tomorrow;
    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    protected $strBusyTimeTo3;
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $boolBusyTimeTo3Tomorrow;
    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    protected $strBusyTimeTo4;
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $boolBusyTimeTo4Tomorrow;
    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    protected $strBusyTimeTo5;
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $boolBusyTimeTo5Tomorrow;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="證件照必須上傳", groups={"admin_registration_step_three"})
     */
    protected $strCardPhoto;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="半身照必須上傳", groups={"admin_registration_step_three"})
     */
    protected $strBodyPhoto;

    /**
     * @ORM\OneToMany(targetEntity="Song", mappedBy="member")
     */
    protected $songs;




    public function __construct(){
        //$this->arrStrArtistName = new ArrayCollection();
    }

    public function iniArrStrArtistName()
    {
        $this->arrStrArtistName = new ArrayCollection();
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
     * Set intType
     *
     * @param integer $intType
     * @return Member
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
     * Set strLogo
     *
     * @param string $strLogo
     * @return Member
     */
    public function setStrLogo($strLogo)
    {
        $this->strLogo = $strLogo;

        return $this;
    }


    /**
     * Get strLogo
     *
     * @return string 
     */
    public function getStrLogo()
    {
        return $this->strLogo;
    }

    /**
     * Set strAvatar
     *
     * @param string $strAvatar
     * @return Member
     */
    public function setStrAvatar($strAvatar)
    {
        $this->strAvatar = $strAvatar;

        return $this;
    }

    /**
     * Get strAvatar
     *
     * @return string 
     */
    public function getStrAvatar()
    {
        return $this->strAvatar;
    }

    /**
     * Set strFullName
     *
     * @param string $strFullName
     * @return Member
     */
    public function setStrFullName($strFullName)
    {
        $this->strFullName = $strFullName;

        return $this;
    }

    /**
     * Get strFullName
     *
     * @return string 
     */
    public function getStrFullName()
    {
        return $this->strFullName;
    }

    /**
     * Set strShortName
     *
     * @param string $strShortName
     * @return Member
     */
    public function setStrShortName($strShortName)
    {
        $this->strShortName = $strShortName;

        return $this;
    }

    /**
     * Get strShortName
     *
     * @return string 
     */
    public function getStrShortName()
    {
        return $this->strShortName;
    }

    /**
     * Set intProvinceId
     *
     * @param integer $intProvinceId
     * @return Member
     */
    public function setIntProvinceId($intProvinceId)
    {
        $this->intProvinceId = $intProvinceId;

        return $this;
    }

    /**
     * Get intProvinceId
     *
     * @return integer 
     */
    public function getIntProvinceId()
    {
        return $this->intProvinceId;
    }

    /**
     * Set intCityId
     *
     * @param integer $intCityId
     * @return Member
     */
    public function setIntCityId($intCityId)
    {
        $this->intCityId = $intCityId;

        return $this;
    }

    /**
     * Get intCityId
     *
     * @return integer 
     */
    public function getIntCityId()
    {
        return $this->intCityId;
    }

    /**
     * Set strAddressInfo
     *
     * @param string $strAddressInfo
     * @return Member
     */
    public function setStrAddressInfo($strAddressInfo)
    {
        $this->strAddressInfo = $strAddressInfo;

        return $this;
    }

    /**
     * Get strAddressInfo
     *
     * @return string 
     */
    public function getStrAddressInfo()
    {
        return $this->strAddressInfo;
    }

    /**
     * Set strZipCode
     *
     * @param string $strZipCode
     * @return Member
     */
    public function setStrZipCode($strZipCode)
    {
        $this->strZipCode = $strZipCode;

        return $this;
    }

    /**
     * Get strZipCode
     *
     * @return string 
     */
    public function getStrZipCode()
    {
        return $this->strZipCode;
    }

    /**
     * Set strTel
     *
     * @param string $strTel
     * @return Member
     */
    public function setStrTel($strTel)
    {
        $this->strTel = $strTel;

        return $this;
    }

    /**
     * Get strTel
     *
     * @return string 
     */
    public function getStrTel()
    {
        return $this->strTel;
    }

    /**
     * Set arrStrArtistName
     *
     * @param array $arrStrArtistName
     * @return Member
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
     * Set strIntro
     *
     * @param string $strIntro
     * @return Member
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
     * Set strUserName
     *
     * @param string $strUserName
     * @return Member
     */
    public function setStrUserName($strUserName)
    {
        $this->strUserName = $strUserName;

        return $this;
    }

    /**
     * Get strUserName
     *
     * @return string 
     */
    public function getStrUserName()
    {
        return $this->strUserName;
    }

    /**
     * Set strUserNickName
     *
     * @param string $strUserNickName
     * @return Member
     */
    public function setStrUserNickName($strUserNickName)
    {
        $this->strUserNickName = $strUserNickName;

        return $this;
    }

    /**
     * Get strUserNickName
     *
     * @return string 
     */
    public function getStrUserNickName()
    {
        return $this->strUserNickName;
    }

    /**
     * Set intUserGender
     *
     * @param integer $intUserGender
     * @return Member
     */
    public function setIntUserGender($intUserGender)
    {
        $this->intUserGender = $intUserGender;

        return $this;
    }

    /**
     * Get intUserGender
     *
     * @return integer 
     */
    public function getIntUserGender()
    {
        return $this->intUserGender;
    }

    /**
     * Set strUserCitizenId
     *
     * @param string $strUserCitizenId
     * @return Member
     */
    public function setStrUserCitizenId($strUserCitizenId)
    {
        $this->strUserCitizenId = $strUserCitizenId;

        return $this;
    }

    /**
     * Get strUserCitizenId
     *
     * @return string 
     */
    public function getStrUserCitizenId()
    {
        return $this->strUserCitizenId;
    }

    /**
     * Set strUserMobile
     *
     * @param string $strUserMobile
     * @return Member
     */
    public function setStrUserMobile($strUserMobile)
    {
        $this->strUserMobile = $strUserMobile;

        return $this;
    }

    /**
     * Get strUserMobile
     *
     * @return string 
     */
    public function getStrUserMobile()
    {
        return $this->strUserMobile;
    }

    /**
     * Set strUserTel
     *
     * @param string $strUserTel
     * @return Member
     */
    public function setStrUserTel($strUserTel)
    {
        $this->strUserTel = $strUserTel;

        return $this;
    }

    /**
     * Get strUserTel
     *
     * @return string 
     */
    public function getStrUserTel()
    {
        return $this->strUserTel;
    }

    /**
     * Set strUserQQ
     *
     * @param string $strUserQQ
     * @return Member
     */
    public function setStrUserQQ($strUserQQ)
    {
        $this->strUserQQ = $strUserQQ;

        return $this;
    }

    /**
     * Get strUserQQ
     *
     * @return string 
     */
    public function getStrUserQQ()
    {
        return $this->strUserQQ;
    }


    /**
     * Set strSite
     *
     * @param string $strSite
     * @return Member
     */
    public function setStrSite($strSite)
    {
        $this->strSite = $strSite;

        return $this;
    }

    /**
     * Get strSite
     *
     * @return string 
     */
    public function getStrSite()
    {
        return $this->strSite;
    }

    /**
     * Set boolIsValid
     *
     * @param boolean $boolIsValid
     * @return Member
     */
    public function setBoolIsValid($boolIsValid)
    {
        $this->boolIsValid = $boolIsValid;

        return $this;
    }

    /**
     * Get boolIsValid
     *
     * @return boolean 
     */
    public function getBoolIsValid()
    {
        return $this->boolIsValid;
    }


    /**
     * Set strEMail
     *
     * @param string $strEMail
     * @return Member
     */
    public function setStrEMail($strEMail)
    {
        $this->strEMail = $strEMail;

        return $this;
    }

    /**
     * Get strEMail
     *
     * @return string 
     */
    public function getStrEMail()
    {
        return $this->strEMail;
    }

    /**
     * Set strPassword
     *
     * @param string $strPassword
     * @return Member
     */
    public function setStrPassword($strPassword)
    {
        $this->strPassword = $strPassword;

        return $this;
    }

    /**
     * Get strPassword
     *
     * @return string 
     */
    public function getStrPassword()
    {
        return $this->strPassword;
    }

    /**
     * Set intLevel
     *
     * @param integer $intLevel
     * @return Member
     */
    public function setIntLevel($intLevel)
    {
        $this->intLevel = $intLevel;

        return $this;
    }

    /**
     * Get intLevel
     *
     * @return integer 
     */
    public function getIntLevel()
    {
        return $this->intLevel;
    }

    /**
     * Set intFMType
     *
     * @param integer $intFMType
     * @return Member
     */
    public function setIntFMType($intFMType)
    {
        $this->intFMType = $intFMType;

        return $this;
    }

    /**
     * Get intFMType
     *
     * @return integer 
     */
    public function getIntFMType()
    {
        return $this->intFMType;
    }

    /**
     * Set floatFMValue
     *
     * @param string $floatFMValue
     * @return Member
     */
    public function setFloatFMValue($floatFMValue)
    {
        $this->floatFMValue = $floatFMValue;

        return $this;
    }

    /**
     * Get floatFMValue
     *
     * @return string 
     */
    public function getFloatFMValue()
    {
        return $this->floatFMValue;
    }

    /**
     * Set intFMValueType
     *
     * @param integer $intFMValueType
     * @return Member
     */
    public function setIntFMValueType($intFMValueType)
    {
        $this->intFMValueType = $intFMValueType;

        return $this;
    }

    /**
     * Get intFMValueType
     *
     * @return integer 
     */
    public function getIntFMValueType()
    {
        return $this->intFMValueType;
    }

    /**
     * Set strFMFactor
     *
     * @param string $strFMFactor
     * @return Member
     */
    public function setStrFMFactor($strFMFactor)
    {
        $this->strFMFactor = $strFMFactor;

        return $this;
    }

    /**
     * Get strFMFactor
     *
     * @return string 
     */
    public function getStrFMFactor()
    {
        return $this->strFMFactor;
    }

    /**
     * Set strFMFoundTime
     *
     * @param string $strFMFoundTime
     * @return Member
     */
    public function setStrFMFoundTime($strFMFoundTime)
    {
        $this->strFMFoundTime = $strFMFoundTime;

        return $this;
    }

    /**
     * Get strFMFoundTime
     *
     * @return string
     */
    public function getStrFMFoundTime()
    {
        return $this->strFMFoundTime;
    }

    /**
     * Set strFMCoverPopular
     *
     * @param string $strFMCoverPopular
     * @return Member
     */
    public function setStrFMCoverPopular($strFMCoverPopular)
    {
        $this->strFMCoverPopular = $strFMCoverPopular;

        return $this;
    }

    /**
     * Get strFMCoverPopular
     *
     * @return string 
     */
    public function getStrFMCoverPopular()
    {
        return $this->strFMCoverPopular;
    }

    /**
     * Set strFMJoinAct
     *
     * @param string $strFMJoinAct
     * @return Member
     */
    public function setStrFMJoinAct($strFMJoinAct)
    {
        $this->strFMJoinAct = $strFMJoinAct;

        return $this;
    }

    /**
     * Get strFMJoinAct
     *
     * @return string 
     */
    public function getStrFMJoinAct()
    {
        return $this->strFMJoinAct;
    }

    /**
     * Set intCastWeekDay
     *
     * @param integer $intCastWeekDay
     * @return Member
     */
    public function setIntCastWeekDay($intCastWeekDay)
    {
        $this->intCastWeekDay = $intCastWeekDay;

        return $this;
    }

    /**
     * Get intCastWeekDay
     *
     * @return integer 
     */
    public function getIntCastWeekDay()
    {
        return $this->intCastWeekDay;
    }

    /**
     * Set strCastTimeFrom
     *
     * @param string $strCastTimeFrom
     * @return Member
     */
    public function setStrCastTimeFrom($strCastTimeFrom)
    {
        $this->strCastTimeFrom = $strCastTimeFrom;

        return $this;
    }

    /**
     * Get strCastTimeFrom
     *
     * @return string 
     */
    public function getStrCastTimeFrom()
    {
        return $this->strCastTimeFrom;
    }

    /**
     * Set strCastTimeTo
     *
     * @param string $strCastTimeTo
     * @return Member
     */
    public function setStrCastTimeTo($strCastTimeTo)
    {
        $this->strCastTimeTo = $strCastTimeTo;

        return $this;
    }

    /**
     * Get strCastTimeTo
     *
     * @return string 
     */
    public function getStrCastTimeTo()
    {
        return $this->strCastTimeTo;
    }

    /**
     * Set strSeniority
     *
     * @param string $strSeniority
     * @return Member
     */
    public function setStrSeniority($strSeniority)
    {
        $this->strSeniority = $strSeniority;

        return $this;
    }

    /**
     * Get strSeniority
     *
     * @return string 
     */
    public function getStrSeniority()
    {
        return $this->strSeniority;
    }

    /**
     * Set intCastType
     *
     * @param integer $intCastType
     * @return Member
     */
    public function setIntCastType($intCastType)
    {
        $this->intCastType = $intCastType;

        return $this;
    }

    /**
     * Get intCastType
     *
     * @return integer 
     */
    public function getIntCastType()
    {
        return $this->intCastType;
    }

    /**
     * Set intBusyWeekDayFrom1
     *
     * @param integer $intBusyWeekDayFrom1
     * @return Member
     */
    public function setIntBusyWeekDayFrom1($intBusyWeekDayFrom1)
    {
        $this->intBusyWeekDayFrom1 = $intBusyWeekDayFrom1;

        return $this;
    }

    /**
     * Get intBusyWeekDayFrom1
     *
     * @return integer 
     */
    public function getIntBusyWeekDayFrom1()
    {
        return $this->intBusyWeekDayFrom1;
    }

    /**
     * Set intBusyWeekDayFrom2
     *
     * @param integer $intBusyWeekDayFrom2
     * @return Member
     */
    public function setIntBusyWeekDayFrom2($intBusyWeekDayFrom2)
    {
        $this->intBusyWeekDayFrom2 = $intBusyWeekDayFrom2;

        return $this;
    }

    /**
     * Get intBusyWeekDayFrom2
     *
     * @return integer 
     */
    public function getIntBusyWeekDayFrom2()
    {
        return $this->intBusyWeekDayFrom2;
    }

    /**
     * Set intBusyWeekDayFrom3
     *
     * @param integer $intBusyWeekDayFrom3
     * @return Member
     */
    public function setIntBusyWeekDayFrom3($intBusyWeekDayFrom3)
    {
        $this->intBusyWeekDayFrom3 = $intBusyWeekDayFrom3;

        return $this;
    }

    /**
     * Get intBusyWeekDayFrom3
     *
     * @return integer 
     */
    public function getIntBusyWeekDayFrom3()
    {
        return $this->intBusyWeekDayFrom3;
    }

    /**
     * Set intBusyWeekDayFrom4
     *
     * @param integer $intBusyWeekDayFrom4
     * @return Member
     */
    public function setIntBusyWeekDayFrom4($intBusyWeekDayFrom4)
    {
        $this->intBusyWeekDayFrom4 = $intBusyWeekDayFrom4;

        return $this;
    }

    /**
     * Get intBusyWeekDayFrom4
     *
     * @return integer 
     */
    public function getIntBusyWeekDayFrom4()
    {
        return $this->intBusyWeekDayFrom4;
    }

    /**
     * Set intBusyWeekDayFrom5
     *
     * @param integer $intBusyWeekDayFrom5
     * @return Member
     */
    public function setIntBusyWeekDayFrom5($intBusyWeekDayFrom5)
    {
        $this->intBusyWeekDayFrom5 = $intBusyWeekDayFrom5;

        return $this;
    }

    /**
     * Get intBusyWeekDayFrom5
     *
     * @return integer 
     */
    public function getIntBusyWeekDayFrom5()
    {
        return $this->intBusyWeekDayFrom5;
    }

    /**
     * Set intBusyWeekDayTo1
     *
     * @param integer $intBusyWeekDayTo1
     * @return Member
     */
    public function setIntBusyWeekDayTo1($intBusyWeekDayTo1)
    {
        $this->intBusyWeekDayTo1 = $intBusyWeekDayTo1;

        return $this;
    }

    /**
     * Get intBusyWeekDayTo1
     *
     * @return integer 
     */
    public function getIntBusyWeekDayTo1()
    {
        return $this->intBusyWeekDayTo1;
    }

    /**
     * Set intBusyWeekDayTo2
     *
     * @param integer $intBusyWeekDayTo2
     * @return Member
     */
    public function setIntBusyWeekDayTo2($intBusyWeekDayTo2)
    {
        $this->intBusyWeekDayTo2 = $intBusyWeekDayTo2;

        return $this;
    }

    /**
     * Get intBusyWeekDayTo2
     *
     * @return integer 
     */
    public function getIntBusyWeekDayTo2()
    {
        return $this->intBusyWeekDayTo2;
    }

    /**
     * Set intBusyWeekDayTo3
     *
     * @param integer $intBusyWeekDayTo3
     * @return Member
     */
    public function setIntBusyWeekDayTo3($intBusyWeekDayTo3)
    {
        $this->intBusyWeekDayTo3 = $intBusyWeekDayTo3;

        return $this;
    }

    /**
     * Get intBusyWeekDayTo3
     *
     * @return integer 
     */
    public function getIntBusyWeekDayTo3()
    {
        return $this->intBusyWeekDayTo3;
    }

    /**
     * Set intBusyWeekDayTo4
     *
     * @param integer $intBusyWeekDayTo4
     * @return Member
     */
    public function setIntBusyWeekDayTo4($intBusyWeekDayTo4)
    {
        $this->intBusyWeekDayTo4 = $intBusyWeekDayTo4;

        return $this;
    }

    /**
     * Get intBusyWeekDayTo4
     *
     * @return integer 
     */
    public function getIntBusyWeekDayTo4()
    {
        return $this->intBusyWeekDayTo4;
    }

    /**
     * Set intBusyWeekDayTo5
     *
     * @param integer $intBusyWeekDayTo5
     * @return Member
     */
    public function setIntBusyWeekDayTo5($intBusyWeekDayTo5)
    {
        $this->intBusyWeekDayTo5 = $intBusyWeekDayTo5;

        return $this;
    }

    /**
     * Get intBusyWeekDayTo5
     *
     * @return integer 
     */
    public function getIntBusyWeekDayTo5()
    {
        return $this->intBusyWeekDayTo5;
    }

    /**
     * Set strBusyTimeFrom1
     *
     * @param string $strBusyTimeFrom1
     * @return Member
     */
    public function setStrBusyTimeFrom1($strBusyTimeFrom1)
    {
        $this->strBusyTimeFrom1 = $strBusyTimeFrom1;

        return $this;
    }

    /**
     * Get strBusyTimeFrom1
     *
     * @return string 
     */
    public function getStrBusyTimeFrom1()
    {
        return $this->strBusyTimeFrom1;
    }

    /**
     * Set strBusyTimeFrom2
     *
     * @param string $strBusyTimeFrom2
     * @return Member
     */
    public function setStrBusyTimeFrom2($strBusyTimeFrom2)
    {
        $this->strBusyTimeFrom2 = $strBusyTimeFrom2;

        return $this;
    }

    /**
     * Get strBusyTimeFrom2
     *
     * @return string 
     */
    public function getStrBusyTimeFrom2()
    {
        return $this->strBusyTimeFrom2;
    }

    /**
     * Set strBusyTimeFrom3
     *
     * @param string $strBusyTimeFrom3
     * @return Member
     */
    public function setStrBusyTimeFrom3($strBusyTimeFrom3)
    {
        $this->strBusyTimeFrom3 = $strBusyTimeFrom3;

        return $this;
    }

    /**
     * Get strBusyTimeFrom3
     *
     * @return string 
     */
    public function getStrBusyTimeFrom3()
    {
        return $this->strBusyTimeFrom3;
    }

    /**
     * Set strBusyTimeFrom4
     *
     * @param string $strBusyTimeFrom4
     * @return Member
     */
    public function setStrBusyTimeFrom4($strBusyTimeFrom4)
    {
        $this->strBusyTimeFrom4 = $strBusyTimeFrom4;

        return $this;
    }

    /**
     * Get strBusyTimeFrom4
     *
     * @return string 
     */
    public function getStrBusyTimeFrom4()
    {
        return $this->strBusyTimeFrom4;
    }

    /**
     * Set strBusyTimeFrom5
     *
     * @param string $strBusyTimeFrom5
     * @return Member
     */
    public function setStrBusyTimeFrom5($strBusyTimeFrom5)
    {
        $this->strBusyTimeFrom5 = $strBusyTimeFrom5;

        return $this;
    }

    /**
     * Get strBusyTimeFrom5
     *
     * @return string 
     */
    public function getStrBusyTimeFrom5()
    {
        return $this->strBusyTimeFrom5;
    }

    /**
     * Set strBusyTimeTo1
     *
     * @param string $strBusyTimeTo1
     * @return Member
     */
    public function setStrBusyTimeTo1($strBusyTimeTo1)
    {
        $this->strBusyTimeTo1 = $strBusyTimeTo1;

        return $this;
    }

    /**
     * Get strBusyTimeTo1
     *
     * @return string 
     */
    public function getStrBusyTimeTo1()
    {
        return $this->strBusyTimeTo1;
    }

    /**
     * Set strBusyTimeTo2
     *
     * @param string $strBusyTimeTo2
     * @return Member
     */
    public function setStrBusyTimeTo2($strBusyTimeTo2)
    {
        $this->strBusyTimeTo2 = $strBusyTimeTo2;

        return $this;
    }

    /**
     * Get strBusyTimeTo2
     *
     * @return string 
     */
    public function getStrBusyTimeTo2()
    {
        return $this->strBusyTimeTo2;
    }

    /**
     * Set strBusyTimeTo3
     *
     * @param string $strBusyTimeTo3
     * @return Member
     */
    public function setStrBusyTimeTo3($strBusyTimeTo3)
    {
        $this->strBusyTimeTo3 = $strBusyTimeTo3;

        return $this;
    }

    /**
     * Get strBusyTimeTo3
     *
     * @return string 
     */
    public function getStrBusyTimeTo3()
    {
        return $this->strBusyTimeTo3;
    }

    /**
     * Set strBusyTimeTo4
     *
     * @param string $strBusyTimeTo4
     * @return Member
     */
    public function setStrBusyTimeTo4($strBusyTimeTo4)
    {
        $this->strBusyTimeTo4 = $strBusyTimeTo4;

        return $this;
    }

    /**
     * Get strBusyTimeTo4
     *
     * @return string 
     */
    public function getStrBusyTimeTo4()
    {
        return $this->strBusyTimeTo4;
    }

    /**
     * Set strBusyTimeTo5
     *
     * @param string $strBusyTimeTo5
     * @return Member
     */
    public function setStrBusyTimeTo5($strBusyTimeTo5)
    {
        $this->strBusyTimeTo5 = $strBusyTimeTo5;

        return $this;
    }

    /**
     * Get strBusyTimeTo5
     *
     * @return string 
     */
    public function getStrBusyTimeTo5()
    {
        return $this->strBusyTimeTo5;
    }

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    /**
     * @inheritDoc
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        if($this->getIntType() == Constant::ADMIN)
            return array('ROLE_ADMIN');
        if($this->getIntType() == Constant::FM && $this->getBoolIsValid() == true)
            return array('ROLE_FM');
        if($this->getIntType() == Constant::CORP && $this->getBoolIsValid() == true)
            return array('ROLE_CORP');
        return array('INVALID');
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            //$this->username,
            $this->email,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            //$this->username,
            $this->email,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }



    /**
     * Set username
     *
     * @param string $username
     * @return Member
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Member
     */
    public function setPassword($password)
    {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $this->password = $password;

        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Member
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set boolIsAcceptAuth
     *
     * @param boolean $boolIsAcceptAuth
     * @return Member
     */
    public function setBoolIsAcceptAuth($boolIsAcceptAuth)
    {
        $this->boolIsAcceptAuth = $boolIsAcceptAuth;

        return $this;
    }

    /**
     * Get boolIsAcceptAuth
     *
     * @return boolean 
     */
    public function getBoolIsAcceptAuth()
    {
        return $this->boolIsAcceptAuth;
    }

    /**
     * Set strCardPhoto
     *
     * @param string $strCardPhoto
     * @return Member
     */
    public function setStrCardPhoto($strCardPhoto)
    {
        $this->strCardPhoto = $strCardPhoto;

        return $this;
    }

    /**
     * Get strCardPhoto
     *
     * @return string 
     */
    public function getStrCardPhoto()
    {
        return $this->strCardPhoto;
    }

    /**
     * Set strBodyPhoto
     *
     * @param string $strBodyPhoto
     * @return Member
     */
    public function setStrBodyPhoto($strBodyPhoto)
    {
        $this->strBodyPhoto = $strBodyPhoto;

        return $this;
    }

    /**
     * Get strBodyPhoto
     *
     * @return string 
     */
    public function getStrBodyPhoto()
    {
        return $this->strBodyPhoto;
    }

    public function getAbsolutePathStrLogo()
    {
        return null === $this->strLogo
            ? null
            : $this->getUploadRootDir().'/'.$this->strLogo;
    }

    public function getWebPathStrLogo()
    {
        return null === $this->strLogo
            ? null
            : $this->getUploadDir().'/'.$this->strLogo;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/documents';
    }

    /**
     * Set intStatus
     *
     * @param integer $intStatus
     * @return Member
     */
    public function setIntStatus($intStatus)
    {
        $this->intStatus = $intStatus;

        return $this;
    }

    /**
     * Get intStatus
     *
     * @return integer 
     */
    public function getIntStatus()
    {
        return $this->intStatus;
    }

    public function createAt(){
        $this->setTimeCreateTime( new \DateTime());
    }

    /**
     * Set timeLastLoginTime
     *
     * @param \DateTime $timeLastLoginTime
     * @return Member
     */
    public function setTimeLastLoginTime($timeLastLoginTime)
    {
        $this->timeLastLoginTime = $timeLastLoginTime;

        return $this;
    }

    /**
     * Get timeLastLoginTime
     *
     * @return \DateTime 
     */
    public function getTimeLastLoginTime()
    {
        return $this->timeLastLoginTime;
    }

    /**
     * Set timeCreateTime
     *
     * @param \DateTime $timeCreateTime
     * @return Member
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

    /**
     * Set boolIsOneCoop
     *
     * @param boolean $boolIsOneCoop
     * @return Member
     */
    public function setBoolIsOneCoop($boolIsOneCoop)
    {
        $this->boolIsOneCoop = $boolIsOneCoop;

        return $this;
    }

    /**
     * Get boolIsOneCoop
     *
     * @return boolean 
     */
    public function getBoolIsOneCoop()
    {
        return $this->boolIsOneCoop;
    }

    /**
     * Set boolIsOneRank
     *
     * @param boolean $boolIsOneRank
     * @return Member
     */
    public function setBoolIsOneRank($boolIsOneRank)
    {
        $this->boolIsOneRank = $boolIsOneRank;

        return $this;
    }

    /**
     * Get boolIsOneRank
     *
     * @return boolean 
     */
    public function getBoolIsOneRank()
    {
        return $this->boolIsOneRank;
    }

    /**
     * Set boolCastTimeToTomorrow
     *
     * @param boolean $boolCastTimeToTomorrow
     * @return Member
     */
    public function setBoolCastTimeToTomorrow($boolCastTimeToTomorrow)
    {
        $this->boolCastTimeToTomorrow = $boolCastTimeToTomorrow;

        return $this;
    }

    /**
     * Get boolCastTimeToTomorrow
     *
     * @return boolean 
     */
    public function getBoolCastTimeToTomorrow()
    {
        return $this->boolCastTimeToTomorrow;
    }

    /**
     * Set boolBusyTimeTo1Tomorrow
     *
     * @param boolean $boolBusyTimeTo1Tomorrow
     * @return Member
     */
    public function setBoolBusyTimeTo1Tomorrow($boolBusyTimeTo1Tomorrow)
    {
        $this->boolBusyTimeTo1Tomorrow = $boolBusyTimeTo1Tomorrow;

        return $this;
    }

    /**
     * Get boolBusyTimeTo1Tomorrow
     *
     * @return boolean 
     */
    public function getBoolBusyTimeTo1Tomorrow()
    {
        return $this->boolBusyTimeTo1Tomorrow;
    }

    /**
     * Set boolBusyTimeTo2Tomorrow
     *
     * @param boolean $boolBusyTimeTo2Tomorrow
     * @return Member
     */
    public function setBoolBusyTimeTo2Tomorrow($boolBusyTimeTo2Tomorrow)
    {
        $this->boolBusyTimeTo2Tomorrow = $boolBusyTimeTo2Tomorrow;

        return $this;
    }

    /**
     * Get boolBusyTimeTo2Tomorrow
     *
     * @return boolean 
     */
    public function getBoolBusyTimeTo2Tomorrow()
    {
        return $this->boolBusyTimeTo2Tomorrow;
    }

    /**
     * Set boolBusyTimeTo3Tomorrow
     *
     * @param boolean $boolBusyTimeTo3Tomorrow
     * @return Member
     */
    public function setBoolBusyTimeTo3Tomorrow($boolBusyTimeTo3Tomorrow)
    {
        $this->boolBusyTimeTo3Tomorrow = $boolBusyTimeTo3Tomorrow;

        return $this;
    }

    /**
     * Get boolBusyTimeTo3Tomorrow
     *
     * @return boolean 
     */
    public function getBoolBusyTimeTo3Tomorrow()
    {
        return $this->boolBusyTimeTo3Tomorrow;
    }

    /**
     * Set boolBusyTimeTo4Tomorrow
     *
     * @param boolean $boolBusyTimeTo4Tomorrow
     * @return Member
     */
    public function setBoolBusyTimeTo4Tomorrow($boolBusyTimeTo4Tomorrow)
    {
        $this->boolBusyTimeTo4Tomorrow = $boolBusyTimeTo4Tomorrow;

        return $this;
    }

    /**
     * Get boolBusyTimeTo4Tomorrow
     *
     * @return boolean 
     */
    public function getBoolBusyTimeTo4Tomorrow()
    {
        return $this->boolBusyTimeTo4Tomorrow;
    }

    /**
     * Set boolBusyTimeTo5Tomorrow
     *
     * @param boolean $boolBusyTimeTo5Tomorrow
     * @return Member
     */
    public function setBoolBusyTimeTo5Tomorrow($boolBusyTimeTo5Tomorrow)
    {
        $this->boolBusyTimeTo5Tomorrow = $boolBusyTimeTo5Tomorrow;

        return $this;
    }

    /**
     * Get boolBusyTimeTo5Tomorrow
     *
     * @return boolean 
     */
    public function getBoolBusyTimeTo5Tomorrow()
    {
        return $this->boolBusyTimeTo5Tomorrow;
    }


    public function isAccountNonExpired(){
        return true;
    }
    public function isAccountNonLocked(){
        return true;
    }
    public function isCredentialsNonExpired(){
        return true;
    }
    public function isEnabled(){
        return $this->boolIsValid;
    }

    /**
     * Add songs
     *
     * @param \Acme\BackendBundle\Entity\Song $songs
     * @return Member
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
}
