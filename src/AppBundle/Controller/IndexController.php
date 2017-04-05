<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    /**
     * @Route "/" name="home")
     */
    public function indexAction()
    {
        $number = mt_rand(0, 100);
        return $this->render('index.html.twig');
    }
}
