<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CoreBundle\Entity\Media;
use Doctrine\ORM\EntityRepository;



class CoreController extends Controller
{
    public function homeAction()
    {
        return $this->render('CoreBundle:Core:index.html.twig');
    }
    
    public function newContentAction() {
        
        
        
        
        $repo = $this->getDoctrine()->getManager()->getRepository('CoreBundle:Media');
        $newContent =  $repo->getNewContent();
        return $this->render('CoreBundle:Core:newContent.html.twig', array('newContent' => $newContent));
        
        
    }
    public function accessInfosAction() {
        
        return $this->render('CoreBundle:Core:informations.html.twig');
    }
    
    public function accessCatalogueAction() {
        
        $catalogue = $this->getDoctrine()->getManager()->getRepository('CoreBundle:Media')->findAll();
        return $this->render('CoreBundle:Core:catalogue.html.twig', array('catalogue' => $catalogue));
    }
}


