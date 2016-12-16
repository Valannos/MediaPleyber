<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * 
 * Event
 * 
 * @ORM\Table(name="event")
 * @ORM\Entity
 * 
 * 
 */
class Event {
    //put your code here
    
    /**
     * 
     * @var integer
     * 
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * 
     */
    
    private $id;
    
    /**
     * 
     * @var string
     * 
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     * 
     * 
     */
    
    private $title;
    
    /**
     * 
     * @var string
     * 
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     * 
     * 
     */
    
    private $description;
    
    /**
     * 
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=255, nullable=false)
     * 
     */
     private $lieu;
     
     /**
      * @var \DateTime
      * 
      * @ORM\Column(name="date", type="datetime", nullable=false)
      *  
      * 
      */
     
     private $date;
    
     function getId() {
         return $this->id;
     }

     function getTitle() {
         return $this->title;
     }

     function getDescription() {
         return $this->description;
     }

     function getLieu() {
         return $this->lieu;
     }

     function getDate(): \DateTime {
         return $this->date;
     }

     function setId($id) {
         $this->id = $id;
     }

     function setTitle($title) {
         $this->title = $title;
     }

     function setDescription($description) {
         $this->description = $description;
     }

     function setLieu($lieu) {
         $this->lieu = $lieu;
     }

     function setDate(\DateTime $date) {
         $this->date = $date;
     }


    
}
