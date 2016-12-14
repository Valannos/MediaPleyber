<?php

namespace CoreBundle\Repository;

use CoreBundle\Entity\Reservation;
use CoreBundle\Repository\MediaRepository;

/**
 * ReservationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ReservationRepository extends \Doctrine\ORM\EntityRepository {

    public function createReservation($user, $media_id) {

        $resa = new Reservation();
        $today = new \DateTime();
        $resa->setDate($today);
        var_dump($media_id);

        $resa->setUser($user);

        $media = $this->getEntityManager()->getRepository('CoreBundle:Media')->find($media_id);
        $resa->setMedia($media);
        $em = $this->getEntityManager();
        $em->persist($resa);
        $em->flush();


        return true;
    }
    
    public function getUserReservations($user) {
        
      $qb =  $this->createQueryBuilder('r')
             ->where('r.user = :user')
             ->setParameter('user', $user);
        
        return $qb->getQuery()->getResult();
        
    }

}
