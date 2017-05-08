<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SongsController extends Controller
{
    /**
     * @Route ("/projects/songs", name="songs")
     */
    public function songsAction()
    {
        return $this->render('songs.html.twig');
    }
}
