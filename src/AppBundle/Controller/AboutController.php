<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AboutController extends Controller
{
    /**
     * @Route ("/about", name="about")
     */
    public function aboutAction()
    {
        return $this->render('about.html.twig');
    }
}
