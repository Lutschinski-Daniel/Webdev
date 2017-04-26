<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Vocab;

class VocabController extends Controller {
    
     /**
     * @Route ("/projects/vocabs", name="vocabs")
     */
    public function listVocabsAction(){
        $vocabs = $this->getDoctrine()->getRepository('AppBundle:Vocab')->findAll();
        
        return $this->render('vocabs.html.twig', [
            'vocabs' => $vocabs
        ]);
    }
    
    /**
     * @Route ("/projects/vocabs/create", name="create")
     */
    public function createVocabAction() {
        $em = $this->getDoctrine()->getManager();
 
        $ger = filter_input(INPUT_GET, 'german');
        $for = filter_input(INPUT_GET, 'foreign');

        if(empty($ger) || empty($for) ){
            return $this->redirectToRoute('vocabs');
        }
        
         /** @var $vocab Vocab */
        $vocab = new Vocab($ger, $for);

        $em->persist($vocab);
        $em->flush();

        return $this->redirectToRoute('vocabs');
    }
}
