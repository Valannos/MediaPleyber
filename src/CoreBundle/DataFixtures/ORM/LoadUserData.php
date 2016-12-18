<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CoreBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class LoadUserData implements FixtureInterface, ContainerAwareInterface {

    /**
     * 
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function load(ObjectManager $manager) {
        $listFirstName = array('Alain', 'Anne', 'Jean', 'Marie');
        $listLastNames = array('Messager', 'Le Floc\'h', 'Le Goff', 'Le Gall');
       for  ($i = 0; $i < 3; $i++) {
            
                $user = new User();
                $user->setLastname($listLastNames[$i]);
                $user->setPlainpassword($listLastNames[$i]);
                                      
                $user->setFirstname($listFirstName[$i]);
                $user->setUsername($listLastNames[$i]);
                $password = $this->container->get('security.password_encoder')
                                            ->encodePassword($user, $user->getPlainPassword());
                
                $user->setPassword($password);
                if ($user->getLastname() === 'Messager') {
                    $user->setRoles(array('ROLE_GESTION'));
                } else {
                    $user->setRoles(array('ROLE_REGISTERED'));
                }
                $user->setSalt('');
                
                $manager->persist($user);
            
        }
        $manager->flush();
        
    }

}
