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
     * @ORM\Column(type="integer")
     */
    protected $intFromMemberId;
    /**
     * @ORM\Column(type="integer")
     */
    protected $intToMemberId;
    /**
     * @ORM\Column(type="integer")
     */
    protected $intDateTime;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $strContent;


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
}
