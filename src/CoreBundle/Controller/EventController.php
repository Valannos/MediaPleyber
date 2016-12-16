<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Description of EventController
 *
 * @author vanel
 */
class EventController extends Controller {

    //put your code here

    public function displaysEventAction() {

        $events = $this->getDoctrine()
                ->getManager()
                ->getRepository('CoreBundle:Event')
                ->findAll();

        foreach ($events as $event) {
            
            $response[] = array(
              
                "title" => $event->getTitle(),
                "lieu" => $event->getLieu(),
                "date" => $event->getDate(),
                "description" => $event->getDescription(),
                
                
            );
            
        }
        
        $json_response = new JsonResponse($response);
        
       
           
        
        
        

        return $json_response;
    }

}
