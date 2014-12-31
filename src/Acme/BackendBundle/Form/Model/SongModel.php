<?php
namespace Acme\BackendBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

use Acme\BackendBundle\Entity\Song;
use Acme\BackendBundle\Entity\Constant;

class SongModel
{
    /**
     * @Assert\Type(type="Acme\BackendBundle\Entity\Song")
     * @Assert\Valid()
     */
    protected $song;


    public function setSong(Song $song)
    {
        $this->song = $song;
    }

    public function getSong()
    {
        return $this->song;
    }
}