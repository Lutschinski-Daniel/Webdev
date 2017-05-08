<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OptionsController extends Controller
{
    /**
     * @Route ("/options", name="options")
     */
    public function optionsAction(Request $request)
    {
        // show options to user if still logged in
        if( $request->getSession()->has('user') ){
            return $this->render('options.html.twig');
        // redirect if logged off
        } else {
             return $this->redirectToRoute('home');
        }
        
    }
}
