<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LogoutController extends Controller {
    
     /**
     * @Route ("/logout", name="logout")
     */
    public function logoutAction(Request $request){
        
        // user session zerstören
        $request->getSession()->invalidate();
        
        // notice to user that he is logged in
        $this->addFlash(
            'loggedout',
            'You successfully logged out.'
        );
        
        return $this->redirectToRoute('home');
    }
}
