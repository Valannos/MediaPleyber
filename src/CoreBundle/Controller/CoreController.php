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
        
        $repo = $this->getDoctrine()->getManager()->getRepository('CoreBundle:Media')->getNewContent();
        $newContent =  $repo->getNewContent();
        return $this->render('CoreBundle:Core:newContent.html.twig', array('newContent' => $newContent));
        
        
    }
}


