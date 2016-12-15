<?php

namespace CoreBundle\Repository;

use CoreBundle\Entity\Loan;
use CoreBundle\Entity\Reservation;
use CoreBundle\Entity\Media;

/**
 * LoanRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LoanRepository extends \Doctrine\ORM\EntityRepository {

    public function createLoan(Reservation $res, Media $media) {
        $em = $this->getEntityManager();
        $loan = new Loan();

        $today = new \DateTime();
        $loan->setLoanDate($today);
        $loan->setMedia($media);
        $loan->setUser($res->getUser());
        $loan->setIsReturned(0);
        $em->persist($loan);
        $em->flush();

        return true;
    }

    public function changeIsReturnedState(Loan $loan) {

        if ($loan->getIsReturned() == 0) {
            $loan->setIsReturned(1);
        } else {
            $loan->setIsReturned(0);
        }
        $em = $this->getEntityManager();
        $em->persist($loan);
        $em->flush();
        return true;
    }

}
