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
 * @ORM\Entity(repositoryClass="Acme\BackendBundle\Entity\CorpRepository")
 */
class Corp implements UserInterface, \Serializable
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
     * @Assert\NotBlank(message="邮件帐号必填", groups={"corp_registration_step_one"})
     * @Assert\Email(message="请填写正确邮件帐号")
     */
    public $email;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     * @Assert\NotBlank(message="密码必填", groups={"corp_registration_step_one"})
     */
    public $password;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    public $username;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    public $isAcceptAuth;

    /**
     * @ORM\Column(type="string",length=50, nullable=true)
     * @Assert\NotBlank(message="公司全称必填", groups={"corp_registration_step_two"})
     */
    public $strFullName;
    /**
     * @ORM\Column(type="string",length=50, nullable=true)
     * @Assert\NotBlank(message="公司简称必填", groups={"corp_registration_step_two"})
     */
    public $strShortName;
    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotBlank(message="省份必填", groups={"corp_registration_step_two"})
     */
    public $intProvinceId;
    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotBlank(message="城市必填", groups={"corp_registration_step_two"})
     */
    public $intCityId;
    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     * @Assert\NotBlank(message="详细地址信息必填", groups={"corp_registration_step_two"})
     */
    public $strAddressInfo;
    /**
     * @ORM\Column(type="string",length=10, nullable=true)
     */
    public $strZipCode;
    /**
     * @ORM\Column(type="string",length=20, nullable=true)
     * @Assert\NotBlank(message="公司电话必填", groups={"corp_registration_step_two"})
     */
    public $strTel;
    /**
     * @ORM\Column(type="array", nullable=true)
     */
    public $arrStrArtistName;
    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     */
    public $strIntro;
    /**
     * @ORM\Column(type="string",length=50, nullable=true)
     */
    public $strUserName;
    /**
     * @ORM\Column(type="string",length=30, nullable=true)
     * @Assert\NotBlank(message="艺名必填", groups={"corp_registration_step_three"})
     */
    public $strUserNickName;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $intUserGender;
    /**
     * @ORM\Column(type="string",length=20, nullable=true)
     */
    public $strUserCitizenId;
    /**
     * @ORM\Column(type="string",length=20, nullable=true)
     * @Assert\NotBlank(message="移动电话号码必填", groups={"corp_registration_step_three"})
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
     *     groups={"corp_registration_step_two"}
     * )
     */
    public $strLogo;
    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     * @Assert\Image(
     *     maxSize = "500k",
     *     mimeTypesMessage="无效图片格式",
     *     maxSizeMessage="文件超过500k",
     *     groups={"corp_registration_step_three"}
     * )
     */
    public $strCardPhoto;
    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     * @Assert\Image(
     *     maxSize = "500k",
     *     mimeTypesMessage="无效图片格式",
     *     maxSizeMessage="文件超过500k",
     *     groups={"corp_registration_step_three"}
     * )
     */
    public $strBodyPhoto;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $intStatus;

    public function __construct()
    {
        //$this->arrStrArtistName = new ArrayCollection();
    }
    public function iniArrStrArtistNameCollection()
    {
        $this->arrStrArtistName = new ArrayCollection();
        return $this;
    }

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
        return array('TEMP_CORP');
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
     * Set isAcceptAuth
     *
     * @param boolean $isAcceptAuth
     * @return Corp
     */
    public function setIsAcceptAuth($isAcceptAuth)
    {
        $this->isAcceptAuth = $isAcceptAuth;

        return $this;
    }

    /**
     * Get isAcceptAuth
     *
     * @return boolean 
     */
    public function getIsAcceptAuth()
    {
        return $this->isAcceptAuth;
    }

    /**
     * Set strFullName
     *
     * @param string $strFullName
     * @return Corp
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
     * @return Corp
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
     * Set strAddressInfo
     *
     * @param string $strAddressInfo
     * @return Corp
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
     * @return Corp
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
     * @return Corp
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
     * @param string $arrStrArtistName
     * @return Corp
     */
    public function setArrStrArtistName($arrStrArtistName)
    {
        $this->arrStrArtistName = $arrStrArtistName;

        return $this;
    }

    /**
     * Get arrStrArtistName
     *
     * @return string 
     */
    public function getArrStrArtistName()
    {
        return $this->arrStrArtistName;
    }

    /**
     * Set strIntro
     *
     * @param string $strIntro
     * @return Corp
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
     * @return Corp
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
     * @return Corp
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
     * Set strUserCitizenId
     *
     * @param string $strUserCitizenId
     * @return Corp
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
     * @return Corp
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
     * @return Corp
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
     * @return Corp
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
     * Set strCardPhoto
     *
     * @param string $strCardPhoto
     * @return Corp
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
     * @return Corp
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

    /**
     * Set intProvinceId
     *
     * @param integer $intProvinceId
     * @return Corp
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
     * @return Corp
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
     * Set intUserGender
     *
     * @param integer $intUserGender
     * @return Corp
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
     * Set intStatus
     *
     * @param integer $intStatus
     * @return Corp
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
     * Set strLogo
     *
     * @param string $strLogo
     * @return Corp
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

}
