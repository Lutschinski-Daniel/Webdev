<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Vocab;

class VocabController extends Controller {
    
     /**
     * @Route ("/projects/vocabs", name="vocabs")
     */
    public function listAction(){
        $vocabs = $this->getDoctrine()->getRepository('AppBundle:Vocab')->findAll();
        
        return $this->render('vocabs.html.twig', [
            'vocabs' => $vocabs
        ]);
    }
    
    /**
     * @Route ("/projects/vocabs/create", name="create")
     */
    public function createAction(Request $request) {
        //one possibility to do it
        //$ger = filter_input(INPUT_GET, 'german');
        //$for = filter_input(INPUT_GET, 'foreign');
        
        // better possibility to do it
        $ger = $request->query->get('german');
        $for = $request->query->get('foreign');

        if( empty($ger) || empty($for) ){
            return $this->redirectToRoute('vocabs');
        }
        
        /** @var $vocab Vocab */
        $vocab = new Vocab($ger, $for);
        if( $request->getSession()->has('voccreated') ){
            $request->getSession()->set('voccreated', $request->getSession()->get('voccreated')+1);
        } else {
            $request->getSession()->set('voccreated', 1);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($vocab);
        $em->flush();

        // notice to user
        $this->addFlash(
            'notice',
            'New Vocab created!'
        );
        
        
        return $this->redirectToRoute('vocabs');
    }
}
