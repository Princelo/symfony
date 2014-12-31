<?php

namespace Acme\BackendBundle\Controller;

use Acme\BackendBundle\Entity\Constant;
use Acme\BackendBundle\Entity\Menu;
use Acme\BackendBundle\Form\Type\AdminWizardType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Acme\BackendBundle\Form\Type\AdminRegistrationType;
use Acme\BackendBundle\Form\Type\CorpRegistrationType;
use Acme\BackendBundle\Form\Type\FMRegistrationType;
use Acme\BackendBundle\Form\Model\Registration;
use Acme\BackendBundle\Form\Model\CorpRegistration;
use Acme\BackendBundle\Form\Model\FMRegistration;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\BackendBundle\Entity\Member;
use Acme\BackendBundle\Entity\Corp;
use Acme\BackendBundle\Entity\FM;
use Acme\BackendBundle\Entity\City;
use Acme\BackendBundle\Entity\Artist;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Session\Session;
use Acme\BackendBundle\Form\Type\SongModelType;
use Acme\BackendBundle\Form\Type\SongType;
use Acme\BackendBundle\Form\Model\SongModel;
use Acme\BackendBundle\Entity\Song;

/**
 * Class DefaultController
 * @package Acme\BackendBundle\Controller
 * @Route("/unvadmin")
 */
class CorpController extends DefaultController
{
    /**
     * @return Response
     * @Route("/corp", name="_corp_index")
     */
    public function corpIndexAction()
    {
        parent::init();
        $arrMemberInfo = array(
            'short_name'    =>  $this->objMember->getStrShortName(),
            'ip'            =>  $this->get('request')->getClientIp(),
            'login_time'    =>  $this->objMember->getTimeLastLoginTime()->format('Y-m-d H:i:s'),
        );
        return $this->render('AcmeBackendBundle:Corp:index.html.twig',
            array('m' => $arrMemberInfo,
                'menu' => $this->menu));
    }

    /**
     * @return Response
     * @Route("/corp/song_add", name="_corp_song_add")
     */
    public function corpSongAddAction()
    {
        parent::init();
        $request = $this->get('request');
        $objORM = $this->getDoctrine()->getManager();
        $type = new SongModelType();
        $strCompany = $this->objMember->getStrShortName();
        $songModel = new SongModel();
        if($request->getMethod() != 'POST'){
            $type->setStrCompany($strCompany);
            $song = new Song();
            $artist1 = new Artist();
            $artist2 = new Artist();
            $artist3 = new Artist();
            $artist4 = new Artist();
            $artist5 = new Artist();
            $song->iniArrStrArtistNameCollection();
            //if($song->getArrStrArtistName()!=null){
            $song->getArrStrArtistName()->add($artist1);
            $song->getArrStrArtistName()->add($artist2);
            $song->getArrStrArtistName()->add($artist3);
            $song->getArrStrArtistName()->add($artist4);
            $song->getArrStrArtistName()->add($artist5);
            //}
            $songModel->setSong($song);
        }
        $form = $this->createForm($type, $songModel, array(
            //'validation_groups' => array('corp_song_add'),
        ));

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $songModel = $form->getData();
                $song = $songModel->getSong();
                $current_member = $this->getUser();
                $song->setMember($current_member);
                if($song->getTimeRankTime() == null
                    && $song->getBoolIsRank())
                    $song->setTimeRankTime(new \DateTime('tomorrow'));
                elseif(!$song->getBoolIsRank())
                    $song->setTimeRankTime(null);
                $objORM->persist($song);
                $objORM->flush();

                return $this->redirect($this->generateUrl('_corp_song_add'));
            }
        }

        return $this->render(
            'AcmeBackendBundle:Corp:song_add.html.twig',
            array('form' => $form->createView(),
                'menu' => $this->menu,
            )
        );
    }


}
