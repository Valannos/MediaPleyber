<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CoreBundle\Entity\Media;
use CoreBundle\Repository\MediaRepository;
use CoreBundle\Repository\LoanRepository;
use Doctrine\ORM\EntityRepository;
use CoreBundle\Repository\ReservationRepository;

class CoreController extends Controller {
    /* ++++++++++++++ACCESS METHODS+++++++++++++++ */

    public function homeAction() {
        return $this->render('CoreBundle:Core:index.html.twig');
    }

    public function newContentAction() {





        $newContent = $this->getMediaRepository()->getNewContent();
        return $this->render('CoreBundle:Core:newContent.html.twig', array('newContent' => $newContent));
    }

    public function accessInfosAction() {

        return $this->render('CoreBundle:Core:informations.html.twig');
    }

    public function accessCatalogueAction() {

        $catalogue = $this->getMediaRepository()->findAll();
        $books = $this->getBookRepository()->findAll();
        $cds = $this->getCdRepository()->findAll();
        $comics = $this->getComicRepository()->findAll();
        return $this->render('CoreBundle:Core:catalogue.html.twig', array('catalogue' => $catalogue, 'books' => $books, 'Cd' => $cds, 'Comics' => $comics));
    }

    /* ++++++++++++++RESERVATIONS AND LOANS METHODS+++++++++++++++ */


    /* -------------------REPOSITORY ACCESS METHODS------------ */

    public function getLoanRepository() {

        return $this->getDoctrine()->getManager()->getRepository('CoreBundle:Loan');
    }

    public function getMediaRepository() {

        return $this->getDoctrine()->getManager()->getRepository('CoreBundle:Media');
    }

    public function getBookRepository() {


        return $this->getDoctrine()->getManager()->getRepository('CoreBundle:Book');
    }

    public function getReservationRepository() {

        return $this->getDoctrine()->getManager()->getRepository('CoreBundle:Reservation');
    }

    public function getCdRepository() {

        return $this->getDoctrine()->getManager()->getRepository('CoreBundle:Cd');
    }

    public function getComicRepository() {

        return $this->getDoctrine()->getManager()->getRepository('CoreBundle:Comic');
    }

    /* ------------------------------------------- */

    public function reserveMediaAction($media_id) {
        if ($media_id == -1) {
            $this->redirectToRoute('core_catalogue');
        }
        $cds = $this->getCdRepository()->findAll();
        $comics = $this->getComicRepository()->findAll();
        $media = $this->getMediaRepository()->find($media_id);
        $update = $this->getMediaRepository()->updateStatutToReserved($media, 2);
        $books = $this->getBookRepository()->findAll();
         $catalogue = $this->getMediaRepository()->findAll();
        if (!$update) {

            return $this->render('CoreBundle:Core:catalogue.html.twig', array('isSuccessfullyReserved' => 0, 'reqMedia' => $media_id, 'books' => $books, 'Cd' => $cds, 'Comics' => $comics));
        }

        $user = $this->get('security.token_storage')->getToken()->getUser();

        if ($this->getReservationRepository()->createReservation($user, $media_id)) {
            return $this->render('CoreBundle:Core:catalogue.html.twig', array('isSuccessfullyReserved' => 2, 'reqMedia' => $media_id, 'books' => $books, 'Cd' => $cds, 'Comics' => $comics));
        } else {


            return $this->render('CoreBundle:Core:catalogue.html.twig', array('isSuccessfullyReserved' => 1, 'reqMedia' => $media_id, 'catalogue' => $catalogue, 'Cd' => $cds, 'Comics' => $comics));
        }
    }

    public function getUserMediaAction() {

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $userReservation = $this->getReservationRepository()->getUserReservations($user);
        $userLoan = $this->getLoanRepository()->getUserLoans($user);
        return $this->render('CoreBundle:Core:ResLoan.html.twig', array('Reservation' => $userReservation, 'Loan' => $userLoan));
    }

    public function manageReservationAction() {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_GESTION')) {
            throw $this->createAccessDeniedException();
        }
        $allLoan = $this->getLoanRepository()->findAll();
        $allRes = $this->getReservationRepository()->getReservationsWithoutEffectiveLoan();
        return $this->render('CoreBundle:Core:AllResAllLoans.html.twig', array('Reservation' => $allRes, 'Loan' => $allLoan));
    }

    public function validLoanAction($res_id) {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_GESTION')) {
            throw $this->createAccessDeniedException();
        }



        $allLoan = $this->getLoanRepository()->findAll();
        $allRes = $this->getReservationRepository()->getReservationsWithoutEffectiveLoan();


        $res = $this->getReservationRepository()->find($res_id);
        $media = $this->getMediaRepository()->getMediaByReservation($res);
        $update = $this->getMediaRepository()->updateStatutToBorrowed($media, 3);

        if (!$update) {



            return $this->redirectToRoute('core_reservation', array('Reservation' => $allRes, 'Loan' => $allLoan, 'isSuccessfullyBorrowed' => false));
        } else {

            $this->getLoanRepository()->createLoan($res, $media);


            $this->getReservationRepository()->changeBorrowedState($res);
            return $this->redirectToRoute('core_reservation', array('Reservation' => $allRes, 'Loan' => $allLoan, 'isSuccessfullyBorrowed' => true));
        }
    }

    public function cancelReservationAction($res_id) {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_GESTION')) {
            throw $this->createAccessDeniedException();
        }
        $allLoan = $this->getLoanRepository()->findAll();
        $allRes = $this->getReservationRepository()->getReservationsWithoutEffectiveLoan();
        $res = $this->getReservationRepository()->find($res_id);
        dump($res);
        if ($res->getStatut() == 1) {

            $res->setStatut(0);
            $this->getDoctrine()->getManager()->persist($res);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('core_reservation', array('Reservation' => $allRes, 'Loan' => $allLoan));
        }
    }

    public function validReturnAction($loan_id) {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_GESTION')) {
            throw $this->createAccessDeniedException();
        }

        $allLoan = $this->getLoanRepository()->findAll();
        $allRes = $this->getReservationRepository()->getReservationsWithoutEffectiveLoan();



        $loan = $this->getLoanRepository()->find($loan_id);
        $today = new \DateTime();
        $loan->setReturnDate($today);
        $media = $this->getMediaRepository()->getMediaByLoan($loan);


        $update = $this->getMediaRepository()->updateStatutToAvailable($media, 1);



        if (!$update) {



            return $this->redirectToRoute('core_reservation', array('Reservation' => $allRes, 'Loan' => $allLoan, 'isSuccessfullyBorrowed' => false));
        } else {

            $this->getLoanRepository()->changeIsReturnedState($loan);

            return $this->redirectToRoute('core_reservation', array('Reservation' => $allRes, 'Loan' => $allLoan, 'isSuccessfullyBorrowed' => true));
        }
    }

}
