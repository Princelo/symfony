<?php

namespace Acme\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Basic
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Acme\BackendBundle\Entity\BasicRepository")
 */
class Basic
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
    protected $intWeekDay;


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
     * Set intWeekDay
     *
     * @param integer $intWeekDay
     * @return Basic
     */
    public function setIntWeekDay($intWeekDay)
    {
        $this->intWeekDay = $intWeekDay;

        return $this;
    }

    /**
     * Get intWeekDay
     *
     * @return integer 
     */
    public function getIntWeekDay()
    {
        return $this->intWeekDay;
    }
}
