<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CoreBundle\Entity\Media;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;


/**
 * Description of LoadMedia
 *
 * @author vanel
 * 
 */
class LoadMedia implements FixtureInterface, ContainerAwareInterface {

    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function load(ObjectManager $manager) {

        $mediaTitle = array(
            'Le Seigneur des Anneaux - Les Deux Tours',
            'La méthamorphose',
            'Les Mots',
            'Asterix chez les Helvètes',
            'Le Horla',
            'Black Metal',
            'Suites pour Violoncelles',
            'Mourir pour des idées',
            'Objectif Lune',
        );

        $mediaType = array(
            0,
            0,
            0,
            2,
            0,
            1,
            1,
            1,
            2,
        );




        $mediaDate = array(
            new \DateTime('2016-10-06'),
            new \DateTime('2016-10-02'),
            new \DateTime('2016-04-19'),
            new \DateTime('2016-05-26'),
            new \DateTime('2016-04-18'),
            new \DateTime('2016-08-17'),
            new \DateTime('2016-10-05'),
            new \DateTime('2015-02-18'),
            new \DateTime('2015-02-03'),
        );







        $mediaCover = array(
            'deux_tour_1.jpeg',
            'meta_kafka.jpg',
            'les_mots_sartre.jpg',
            'asterix_helvetes_cover.jpg',
            'horlacouv-couleur.jpg',
            'black_metal_cover.jpg',
            'cello_vivaldi.jpg',
            'brassens_mourir_pour_des_idees.jpg',
            'herge-objectif_lune.jpg'
        );
        for ($i = 0; $i < 9; $i++) {

            $media = new Media();
            $media->setTitle($mediaTitle[$i]);
            $media->setStatut(1);
            $media->setDate($mediaDate[$i]);
            $media->setType($mediaType[$i]);
            $media->setCover($mediaCover[$i]);
         
            

            $manager->persist($media);
        }
        $manager->flush();
    }

}
