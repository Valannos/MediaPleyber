<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CoreBundle\Entity\Media;
use CoreBundle\Repository\MediaRepository;
use CoreBundle\Repository\LoanRepository;
use Doctrine\ORM\EntityRepository;
use CoreBundle\Repository\ReservationRepository;

class CoreController extends Controller {

    /*++++++++++++++ACCESS METHODS+++++++++++++++*/
    
    
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
    
     /*++++++++++++++RESERVATIONS AND LOANS METHODS+++++++++++++++*/
    

    public function reserveMediaAction($media_id) {
        if ($media_id == -1) {
            $this->redirectToRoute('core_catalogue');
        }
        $mediaRepo = $this->getDoctrine()->getManager()->getRepository('CoreBundle:Media');
        $media = $mediaRepo->find($media_id);
        $update = $mediaRepo->updateStatutToReserved($media, 2);
        $allMedia = $mediaRepo->findAll();
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

    public function manageReservationAction() {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_GESTION')) {
            throw $this->createAccessDeniedException();
        }
        $allLoan = $this->getDoctrine()->getManager()->getRepository('CoreBundle:Loan')->findAll();
        $allRes = $this->getDoctrine()->getManager()->getRepository('CoreBundle:Reservation')->getReservationsWithoutEffectiveLoan();
        return $this->render('CoreBundle:Core:AllResAllLoans.html.twig', array('Reservation' => $allRes, 'Loan' => $allLoan));
    }

    public function validLoanAction($res_id) {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_GESTION')) {
            throw $this->createAccessDeniedException();
        }
        $resRepo = $this->getDoctrine()->getManager()->getRepository('CoreBundle:Reservation');
        
        $mediaRepo = $this->getDoctrine()->getManager()->getRepository('CoreBundle:Media');
        $allLoan = $this->getDoctrine()->getManager()->getRepository('CoreBundle:Loan')->findAll();
        $allRes = $resRepo->getReservationsWithoutEffectiveLoan();


        $res = $this->getDoctrine()->getManager()->getRepository('CoreBundle:Reservation')->find($res_id);
        $media = $mediaRepo->getMediaByReservation($res);
        $update = $mediaRepo->updateStatutToBorrowed($media, 3);

        if (!$update) {



            return $this->redirectToRoute('core_reservation', array('Reservation' => $allRes, 'Loan' => $allLoan, 'isSuccessfullyBorrowed' => false));
        } else {

            $this->getDoctrine()->getManager()->getRepository('CoreBundle:Loan')->createLoan($res, $media);
            
            
             $resRepo->changeBorrowedState($res);       
            return $this->redirectToRoute('core_reservation', array('Reservation' => $allRes, 'Loan' => $allLoan, 'isSuccessfullyBorrowed' => true));
        }
    }

    public function validReturnAction($loan_id) {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_GESTION')) {
            throw $this->createAccessDeniedException();
        }

        $allLoan = $this->getDoctrine()->getManager()->getRepository('CoreBundle:Loan')->findAll();
        $allRes = $this->getDoctrine()->getManager()->getRepository('CoreBundle:Reservation')->getReservationsWithoutEffectiveLoan();
        $loanRepo = $this->getDoctrine()->getManager()->getRepository('CoreBundle:Loan');
        $mediaRepo = $this->getDoctrine()->getManager()->getRepository('CoreBundle:Media');

        $loan = $loanRepo->find($loan_id);
        $today = new \DateTime();
        $loan->setReturnDate($today);
        $media = $mediaRepo->getMediaByLoan($loan);


        $update = $mediaRepo->updateStatutToAvailable($media, 1);



        if (!$update) {

            

            return $this->redirectToRoute('core_reservation', array('Reservation' => $allRes, 'Loan' => $allLoan, 'isSuccessfullyBorrowed' => false));
        } else {

            $loanRepo->changeIsReturnedState($loan);
            
            return $this->redirectToRoute('core_reservation', array('Reservation' => $allRes, 'Loan' => $allLoan, 'isSuccessfullyBorrowed' => true));
        }
    }

}
