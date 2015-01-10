<?php
namespace Acme\BackendBundle\Controller;

use Acme\BackendBundle\Entity\Constant;
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
use Acme\CoreBundle\Controller\CustomerController;
/**
 * @Route("/")
 */
class AccountController extends CustomerController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("register_corp", name="_register_corp")
     */
    public function corpRegisterAction()
    {
        $request = $this->get('request');
        $session  = $request->getSession();
        $objORM = $this->getDoctrine()->getManager();
        $type = new CorpRegistrationType();
        $registration = new CorpRegistration();
        $form = $this->createForm($type, $registration, array(
            //'action' => $this->generateUrl('corp_create'),
            'validation_groups' => array('corp_registration_step_one'),
        ));

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $registration = $form->getData();
                $corp = $registration->getCorp();
                $corp->setIntStatus(1);
                if(!$this->boolCheckUniqueEmail($corp->getEmail()))
                    return $this->redirect('duplicated_email');
                $objORM->persist($corp);
                $objORM->flush();
                $id = $corp->getId();
                $session->set('temp_corp_step', 1);
                $session->set('temp_corp_id', $id);

                return $this->redirect($this->generateUrl('_corp_supplement_1'));
            }
        }

        $objFrontendInfo = $objORM->getRepository('AcmeFrontendBundle:OtherInfo')
            ->getArrFrontendInfo();
        $arrFM = $objORM->getRepository('AcmeBackendBundle:Member')
            ->getArrFMList(30, 'timeCreateTime', 'DESC');
        return $this->render(
            'AcmeFrontendBundle:Registration:register_corp.html.twig',
            array('form' => $form->createView(),
                'otherinfo' =>  $objFrontendInfo,
                'fms' => $arrFM,)
        );
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("corp_supplement_1", name="_corp_supplement_1")
     */
    public function corpSupplement1(Request $request)
    {
        $session = $request->getSession();
        if($session->get('temp_corp_step') != 1
          || $session->get('temp_corp_id') == ""
        )
            return $this->redirect('my404');
        $type = new CorpRegistrationType();
        $id = $session->get('temp_corp_id');
        $registration = new CorpRegistration();
        $city = new City();
        $city = json_encode($city->getArrCity());
        $type->setStep(1);
        $corp = $this->getDoctrine()->getRepository('AcmeBackendBundle:Corp')->find($id);
        if($request->getMethod() != 'POST'){
            $artist1 = new Artist();
            $artist2 = new Artist();
            $artist3 = new Artist();
            $artist4 = new Artist();
            $artist5 = new Artist();
            $corp->iniArrStrArtistNameCollection();
            if($corp->getArrStrArtistName()!=null){
                $corp->getArrStrArtistName()->add($artist1);
                $corp->getArrStrArtistName()->add($artist2);
                $corp->getArrStrArtistName()->add($artist3);
                $corp->getArrStrArtistName()->add($artist4);
                $corp->getArrStrArtistName()->add($artist5);
            }
        }
        $registration->setCorp($corp);
        $objORM = $this->getDoctrine()->getManager();
        $form = $this->createForm($type, $registration, array(
            //'action' => $this->generateUrl('corp_create_1'),
            'validation_groups' => array('corp_registration_step_two'),
        ));
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $registration = $form->getData();
                $corp = $registration->getCorp();
                $strLogo = $this->fileHandleUploadFile($form, 'corp', 'strLogo', 'uploads/corplogo');
                $corp->setIntStatus(2);
                $corp->setStrLogo($strLogo);
                $objORM->persist($corp);
                $objORM->flush();
                $session->set('temp_corp_step', 2);


                return $this->redirect($this->generateUrl('_corp_supplement_2'));
            }
        }

        $objFrontendInfo = $objORM->getRepository('AcmeFrontendBundle:OtherInfo')
            ->getArrFrontendInfo();
        $arrFM = $objORM->getRepository('AcmeBackendBundle:Member')
            ->getArrFMList(30, 'timeCreateTime', 'DESC');

        return $this->render(
            'AcmeFrontendBundle:Registration:register_corp_1.html.twig',
            array('form' => $form->createView(),
                  'city' => $city,
                  'otherinfo' => $objFrontendInfo,
                  'fms' =>  $arrFM,
                )
        );
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("corp_supplement_2", name="_corp_supplement_2")
     */
    public function corpSupplement2(Request $request)
    {
        $session =  $request->getSession();
        if( $session->get('temp_corp_step') != 2
            || $session->get('temp_corp_id') == ""
        )
            return $this->redirect('my404');
        $type = new CorpRegistrationType();
        $registration = new CorpRegistration();
        $type->setStep(2);
        $id = $session->get('temp_corp_id');
        $corp = $this->getDoctrine()->getRepository('AcmeBackendBundle:Corp')->find($id);
        $registration->setCorp($corp);
        $form = $this->createForm($type, $registration, array(
            //'action' => $this->generateUrl('corp_create_2'),
            //'validation_groups' => array('corp_registration_step_three'),
        ));
        $objORM = $this->getDoctrine()->getManager();

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            $objORM = $this->getDoctrine()->getManager();
            if ($form->isValid()) {
                $registration = $form->getData();
                $corp = $registration->getCorp();
                $strCardPhoto = $this->fileHandleUploadFile($form, 'corp', 'strCardPhoto', 'uploads/corpcard');
                $strBodyPhoto = $this->fileHandleUploadFile($form, 'corp', 'strBodyPhoto', 'uploads/corpbody');
                $corp->setIntStatus(3);
                $corp->setStrCardPhoto($strCardPhoto);
                $corp->setStrBodyPhoto($strBodyPhoto);
                $objORM->persist($corp);
                $objORM->flush();
                //$objMember = $objORM->getRepository('AcmeBackendBundle:Member')
                //    ->synCorpData(Constant::CORP, $session->get('temp_corp_id'));
                $member = new Member();
                $member->setIntType(Constant::CORP);
                $member->setBoolIsValid(false);
                $corpReflection = new \ReflectionObject($corp);
                $memberReflection = new \ReflectionObject($member);

                foreach ($corpReflection->getProperties() as $property) {
                    if($property->getName() != "id")
                        if ($memberReflection->hasProperty($property->getName())) {
                            $memberProperty = $memberReflection->getProperty($property->getName());
                            $memberProperty->setAccessible(true);
                            $memberProperty->setValue($member, $property->getValue($corp));
                        }
                }
                $objORM->persist($member);
                $objORM->flush();
                $session->set('temp_corp_step', 3);


                return $this->redirect($this->generateUrl('_corp_finish'));
            }
        }
        $objFrontendInfo = $objORM->getRepository('AcmeFrontendBundle:OtherInfo')
            ->getArrFrontendInfo();
        $arrFM = $objORM->getRepository('AcmeBackendBundle:Member')
            ->getArrFMList(30, 'timeCreateTime', 'DESC');
        return $this->render(
            'AcmeFrontendBundle:Registration:register_corp_2.html.twig',
            array('form' => $form->createView(),
                'otherinfo'=>$objFrontendInfo,
                'fms' => $arrFM,)
        );
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("register_corp_finish", name="_corp_finish")
     */
    public function corpReigsterFinish(Request $request)
    {
        $session = $request->getSession();
        if($session->get('temp_corp_step') != 3)
            return $this->redirect('my404');
        $objORM = $this->getDoctrine()->getManager();
        $objFrontendInfo = $objORM->getRepository('AcmeFrontendBundle:OtherInfo')
            ->getArrFrontendInfo();
        $arrFM = $objORM->getRepository('AcmeBackendBundle:Member')
            ->getArrFMList(30, 'timeCreateTime', 'DESC');
        return $this->render(
            'AcmeFrontendBundle:Registration:register_corp_finish.html.twig',
            array(
                'otherinfo'=>$objFrontendInfo,
                'fms' => $arrFM,)
        );
    }


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("register_fm", name="_register_fm")
     */
    public function fmRegisterAction()
    {
        $type = new FMRegistrationType();
        $registration = new FMRegistration();
        $form = $this->createForm($type, $registration, array(
            //'action' => $this->generateUrl('fm_create'),
            'validation_groups' => array('fm_registration_step_one'),
        ));

        $request = $this->getRequest();
        $session = $request->getSession();
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            $objORM = $this->getDoctrine()->getManager();
            if ($form->isValid()) {
                $registration = $form->getData();
                $fm = $registration->getFM();
                $fm->setIntStatus(1);
                if(!$this->boolCheckUniqueEmail($fm->getEmail()))
                    return $this->redirect($this->generateUrl('_duplicate_email'));
                $objORM->persist($fm);
                $objORM->flush();
                $id = $fm->getId();
                $session->set('temp_fm_step', 1);
                $session->set('temp_fm_id', $id);


                return $this->redirect($this->generateUrl('_fm_supplement_1'));
            }
        }

        $objORM = $this->getDoctrine()->getManager();
        $objFrontendInfo = $objORM->getRepository('AcmeFrontendBundle:OtherInfo')
            ->getArrFrontendInfo();
        $arrFM = $objORM->getRepository('AcmeBackendBundle:Member')
            ->getArrFMList(30, 'timeCreateTime', 'DESC');
        return $this->render(
            'AcmeFrontendBundle:Registration:register_fm.html.twig',
            array('form' => $form->createView(),
                'otherinfo' =>  $objFrontendInfo,
                'fms' => $arrFM,
            )
        );
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("fm_supplement_1", name="_fm_supplement_1")
     */
    public function fmSupplement1(Request $request)
    {
        $session = $request->getSession();
        if($session->get('temp_fm_step') != 1
            || $session->get('temp_fm_id') == ""
        )
            return $this->redirect('my404');
        $type = new FMRegistrationType();
        $id = $session->get('temp_fm_id');
        $fm = $this->getDoctrine()->getRepository('AcmeBackendBundle:FM')->find($id);
        $type->setStep(1);
        $city = new City();
        $city = json_encode($city->getArrCity());
        $registration = new FMRegistration();
        $registration->setFM($fm);
        $objORM = $this->getDoctrine()->getManager();
        $form = $this->createForm($type, $registration, array(
            //'action' => $this->generateUrl('fm_create_1'),
            'validation_groups' => array('fm_registration_step_two'),
        ));
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            $objORM = $this->getDoctrine()->getManager();
            if ($form->isValid()) {
                $registration = $form->getData();
                $fm = $registration->getFM();
                $strLogo = $this->fileHandleUploadFile($form, 'fm', 'strLogo', 'uploads/fmlogo');
                $fm->setIntStatus(2);
                $fm->setStrLogo($strLogo);
                $objORM->persist($fm);
                $objORM->flush();
                $session->set('temp_fm_step', 2);


                return $this->redirect($this->generateUrl('_fm_supplement_2'));
            }
        }

        $objFrontendInfo = $objORM->getRepository('AcmeFrontendBundle:OtherInfo')
            ->getArrFrontendInfo();
        $arrFM = $objORM->getRepository('AcmeBackendBundle:Member')
            ->getArrFMList(30, 'timeCreateTime', 'DESC');
        return $this->render(
            'AcmeFrontendBundle:Registration:register_fm_1.html.twig',
            array('form' => $form->createView(),
                'city' => $city,
                'otherinfo' => $objFrontendInfo,
                'fms' => $arrFM,
            )
        );
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("fm_supplement_2", name="_fm_supplement_2")
     */
    public function fmSupplement2(Request $request)
    {
        $session =  $request->getSession();
        if( $session->get('temp_fm_step') != 2
            || $session->get('temp_fm_id') == ""
        )
            return $this->redirect('my404');
        $type = new FMRegistrationType();
        $id = $session->get('temp_fm_id');
        $fm = $this->getDoctrine()->getRepository('AcmeBackendBundle:FM')->find($id);
        $type->setStep(2);
        $registration = new FMRegistration();
        $registration->setFM($fm);
        $form = $this->createForm($type, $registration, array(
            //'action' => $this->generateUrl('fm_create_2'),
            'validation_groups' => array('fm_registration_step_three'),
        ));
        $objORM = $this->getDoctrine()->getManager();
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $registration = $form->getData();
                $fm = $registration->getFM();
                $strAvatar = $this->fileHandleUploadFile($form, 'fm', 'strAvatar', 'uploads/fmavatar');
                $fm->setIntStatus(3);
                $fm->setStrAvatar($strAvatar);
                $objORM->persist($fm);
                $objORM->flush();
                $member = new Member();
                $member->setIntType(Constant::FM);
                $member->setBoolIsValid(false);
                $fmReflection = new \ReflectionObject($fm);
                $memberReflection = new \ReflectionObject($member);

                foreach ($fmReflection->getProperties() as $property) {
                    if($property->getName() != "id")
                        if ($memberReflection->hasProperty($property->getName())) {
                            $memberProperty = $memberReflection->getProperty($property->getName());
                            $memberProperty->setAccessible(true);
                            $memberProperty->setValue($member, $property->getValue($fm));
                        }
                }
                $objORM->persist($member);
                $objORM->flush();
                $session->set('temp_fm_step', 3);


                return $this->redirect($this->generateUrl('_fm_finish'));
            }
        }
        $objFrontendInfo = $objORM->getRepository('AcmeFrontendBundle:OtherInfo')
            ->getArrFrontendInfo();
        $arrFM = $objORM->getRepository('AcmeBackendBundle:Member')
            ->getArrFMList(30, 'timeCreateTime', 'DESC');
        return $this->render(
            'AcmeFrontendBundle:Registration:register_fm_2.html.twig',
            array('form' => $form->createView(),
                'otherinfo'=>$objFrontendInfo,
                'fms' => $arrFM,)
        );
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("register_fm_finish", name="_fm_finish")
     */
    public function fmReigsterFinish(Request $request)
    {
        $session = $request->getSession();
        if($session->get('temp_fm_step') != 3)
            return $this->redirect('my404');
        $objORM = $this->getDoctrine()->getManager();
        $objFrontendInfo = $objORM->getRepository('AcmeFrontendBundle:OtherInfo')
            ->getArrFrontendInfo();
        $arrFM = $objORM->getRepository('AcmeBackendBundle:Member')
            ->getArrFMList(30, 'timeCreateTime', 'DESC');
        return $this->render(
            'AcmeFrontendBundle:Registration:register_fm_finish.html.twig',
            array(
                'otherinfo'=>$objFrontendInfo,
                'fms' => $arrFM,)
        );
    }

    public function boolCheckUniqueEmail($strEmail){
        $objORM = $this->getDoctrine()->getManager();
        $count = $objORM->getRepository('AcmeBackendBundle:Member')
            ->strCheckUniqueEmail($strEmail);
        if($count > 0)
            return false;
        else
            return true;
    }


    public function fileHandleUploadFile($form, $type, $strField, $strDir)
    {
        //$fileOri = $form->getData()->getMember()[$strField]->getData();
        $fileOri = $form[$type][$strField]->getData();
        if($fileOri=="")
            return "";
        $extension = $fileOri->guessExtension();
        if (!$extension) {
            $extension = 'bin';
        }
        $file = date('YmdHis').rand(1000, 9999).'.'.$extension;
        $fileOri->move($strDir, $file);
        @unlink($fileOri);
        return $file;
    }
}