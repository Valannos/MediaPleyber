<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CoreBundle\Entity\Media;
use Doctrine\ORM\EntityRepository;

class CoreController extends Controller {

    public function homeAction() {
        return $this->render('CoreBundle:Core:index.html.twig');
    }

    public function newContentAction() {




        $repo = $this->getDoctrine()->getManager()->getRepository('CoreBundle:Media');
        $newContent = $repo->getNewContent();
        return $this->render('CoreBundle:Core:newContent.html.twig', array('newContent' => $newContent));
    }

    public function accessInfosAction() {

        return $this->render('CoreBundle:Core:informations.html.twig');
    }

    public function accessCatalogueAction() {

        $catalogue = $this->getDoctrine()->getManager()->getRepository('CoreBundle:Media')->findAll();
        return $this->render('CoreBundle:Core:catalogue.html.twig', array('catalogue' => $catalogue));
    }

    public function reserveMediaAction($media_id) {
        if ($media_id == -1) {
            $this->redirectToRoute('core_catalogue');
        }
        $update = $this->getDoctrine()->getManager()->getRepository('CoreBundle:Media')->updateStatutToReserved($media_id, 2);
        $allMedia = $this->getDoctrine()->getManager()->getRepository('CoreBundle:Media')->findAll();
        if (!$update) {

          return $this->render('CoreBundle:Core:catalogue.html.twig', array('isSuccessfullyReserved' => 0, 'reqMedia' => $media_id, 'catalogue' => $allMedia));
        }

        $user = $this->get('security.token_storage')->getToken()->getUser();

        if ($this->getDoctrine()->getManager()->getRepository('CoreBundle:Reservation')->createReservation($user, $media_id)) {
            return $this->render('CoreBundle:Core:catalogue.html.twig', array('isSuccessfullyReserved' => 2, 'reqMedia' => $media_id, 'catalogue' => $allMedia));
        } else {


            return $this->render('CoreBundle:Core:catalogue.html.twig', array('isSuccessfullyReserved' => 1, 'reqMedia' => $media_id, 'catalogue' => $allMedia));
        }
    }
    
    public function getUserMediaAction() {
        
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $res = $this->getDoctrine()->getManager()->getRepository('CoreBundle:Reservation')->getUserReservations($user);
        return $this->render('CoreBundle:Core:ResLoan.html.twig', array('Reservation' => $res));
    }

}
