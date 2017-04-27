<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProjectsController extends Controller
{
    /**
     * @Route ("/projects", name="projects")
     */
    public function projectsAction()
    {
        // all existing projects
        $projects = [
            ['name' => 'Learn vocabs!', 'urlTo' => 'vocabs'],
            ['name' => 'See songs!', 'urlTo' => 'songs'] 
        ];
        
        return $this->render('projects.html.twig', [
            'projects' => $projects
        ]);
    }
}
