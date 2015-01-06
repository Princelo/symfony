<?php

namespace Acme\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RankLog
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Acme\BackendBundle\Entity\RankLogRepository")
 */
class RankLog
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
     * @return RankLog
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
}
