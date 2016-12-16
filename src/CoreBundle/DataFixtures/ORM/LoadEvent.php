<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CoreBundle\Entity\Event;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class LoadEvent implements FixtureInterface, ContainerAwareInterface {

    /**
     * 
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function load(ObjectManager $manager) {
        
        $eventTitle = array('Bourse aux livres', 'Lectures de Noël');
        $eventLieu = 'Mediathèque de Pleyber';
        $eventDescription = array(
            
            'Vente de livres pour la rentrée 2017, niveau lycée et supérieur',
            'Lecture de contes de Noël pour les tout-petits'
            
        );
        $date_a = new \DateTime(); 
        $date_a->setDate(2017, 8, 20);
        $date_a->setTime(14, 00, 00);
        
        $date_b = new \DateTime(); 
        $date_b->setDate(2017, 12, 20);
        $date_b->setTime(16, 00, 00);
        
        $eventDate = array(
            
            $date_a,
            $date_b
            
        );
        
   
        
        for ($i = 0; $i < 2; $i++) {
            
            $event = new Event();
            $event->setDate($eventDate[$i]);
            $event->setLieu($eventLieu);
            $event->setDescription($eventDescription[$i]);
            $event->setTitle($eventTitle[$i]);
           
            $manager->persist($event);
        }
        
        
       
        
        $manager->flush();
        
    }

}
