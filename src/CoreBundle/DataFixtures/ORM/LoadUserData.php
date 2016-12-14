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
        $listPrenom = array('Alain', 'Anne', 'Jean', 'Marie');
        $listNames = array('Messager', 'Le Floc\'h', 'Le Goff', 'Le Gall');
        foreach ($listNames as $name) {
            
                $user = new User();
                $user->setLastname($name);
                $user->setPlainpassword($name);
                                      
                $user->setFirstname($name);
                $user->setUsername($name);
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
