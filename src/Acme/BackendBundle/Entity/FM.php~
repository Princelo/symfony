<?php

namespace Acme\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Acme\BackendBundle\Entity\Constant;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Corp
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Acme\BackendBundle\Entity\FMRepository")
 */
class FM implements UserInterface, \Serializable
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
     * @ORM\Column(type="string",length=30, nullable=true)
     * @Assert\NotBlank(message="邮件帐号必填", groups={"fm_registration_step_one"})
     * @Assert\Email(message="请填写正确邮件帐号")
     */
    public $email;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     * @Assert\NotBlank(message="密码必填", groups={"fm_registration_step_one"})
     */
    public $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $username;

    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     * @Assert\NotBlank(message="电台全称必填", groups={"fm_registration_step_two"})
     */
    public $strFullName;
    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     * @Assert\NotBlank(message="电台简称必填", groups={"fm_registration_step_two"})
     */
    public $strShortName;
    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotBlank(message="省份必填", groups={"fm_registration_step_two"})
     */
    public $intProvinceId;
    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotBlank(message="城市必填", groups={"fm_registration_step_two"})
     */
    public $intCityId;
    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     * @Assert\NotBlank(message="详细地址信息必填", groups={"fm_registration_step_two"})
     */
    public $strAddressInfo;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $strSite;
    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     */
    public $strUserName;
    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     * @Assert\NotBlank(message="艺名必填", groups={"fm_registration_step_three"})
     */
    public $strUserNickName;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $intUserGender;
    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     */
    public $strUserCitizenId;
    /**
     * @ORM\Column(type="string",length=20, nullable=true)
     * @Assert\NotBlank(message="移动电话号码必填", groups={"fm_registration_step_three"})
     */
    public $strUserMobile;
    /**
     * @ORM\Column(type="string",length=20, nullable=true)
     */
    public $strUserTel;
    /**
     * @ORM\Column(type="string",length=20, nullable=true)
     */
    public $strUserQQ;
    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Image(
     *     maxSize = "500k",
     *     mimeTypesMessage="无效图片格式",
     *     maxSizeMessage="文件超过500k",
     *     groups={"fm_registration_step_two"}
     * )
     */
    public $strLogo;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Image(
     *     maxSize = "500k",
     *     mimeTypesMessage="无效图片格式",
     *     maxSizeMessage="文件超过500k",
     *     groups={"fm_registration_step_two"}
     * )
     */
    public $strAvatar;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotBlank(message="电台等级必填", groups={"fm_registration_step_two"})
     */
    public $intLevel;
    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotBlank(message="电台分类必填", groups={"fm_registration_step_two"})
     */
    public $intFMType;
    /**
     * @ORM\Column(type="decimal", scale=2, nullable=true)
     * @Assert\NotBlank(message="电台频率必填", groups={"fm_registration_step_two"})
     */
    public $floatFMValue;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $intFMValueType;
    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    public $strFMFactor;
    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank(message="电台成立必填", groups={"fm_registration_step_two"})
     */
    public $strFMFoundTime;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $strFMCoverPopular;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="电台加盟必填", groups={"fm_registration_step_two"})
     */
    public $strFMJoinAct;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $intCastWeekDay;
    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    public $strCastTimeFrom;
    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    public $strCastTimeTo;
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    public $boolCastTimeToTomorrow;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="主持人从事时间必填", groups={"fm_registration_step_three"})
     */
    public $strSeniority;
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    public $boolIsOneCoop;
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    public $boolIsOneRank;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $intCastType;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $intBusyWeekDayFrom1;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $intBusyWeekDayFrom2;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $intBusyWeekDayFrom3;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $intBusyWeekDayFrom4;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $intBusyWeekDayFrom5;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $intBusyWeekDayTo1;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $intBusyWeekDayTo2;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $intBusyWeekDayTo3;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $intBusyWeekDayTo4;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $intBusyWeekDayTo5;
    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    public $strBusyTimeFrom1;
    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    public $strBusyTimeFrom2;
    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    public $strBusyTimeFrom3;
    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    public $strBusyTimeFrom4;
    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    public $strBusyTimeFrom5;
    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    public $strBusyTimeTo1;
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    public $boolBusyTimeTo1Tomorrow;
    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    public $strBusyTimeTo2;
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    public $boolBusyTimeTo2Tomorrow;
    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    public $strBusyTimeTo3;
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    public $boolBusyTimeTo3Tomorrow;
    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    public $strBusyTimeTo4;
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    public $boolBusyTimeTo4Tomorrow;
    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    public $strBusyTimeTo5;
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    public $boolBusyTimeTo5Tomorrow;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $intStatus;


    public function setId($id)
    {
        $this->id = $id;
        return $this;
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
        return array('TEMP_FM');
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
     * Set strFullName
     *
     * @param string $strFullName
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * Set strUserName
     *
     * @param string $strUserName
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * Set strLogo
     *
     * @param string $strLogo
     * @return FM
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
     * @return FM
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
     * Set intLevel
     *
     * @param integer $intLevel
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * Set boolIsOneCoop
     *
     * @param boolean $boolIsOneCoop
     * @return FM
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
     * @return FM
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
     * Set intCastType
     *
     * @param integer $intCastType
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * Set intStatus
     *
     * @param integer $intStatus
     * @return FM
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

    /**
     * Set strSite
     *
     * @param string $strSite
     * @return FM
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
     * Set boolBusyTimeTo1Tomorrow
     *
     * @param boolean $boolBusyTimeTo1Tomorrow
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * @return FM
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
     * @return FM
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


    /**
     * Set boolCastTimeToTomorrow
     *
     * @param boolean $boolCastTimeToTomorrow
     * @return FM
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
}
