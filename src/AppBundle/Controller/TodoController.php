<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TodoController extends Controller
{
    /**
     * @Route ("/todo", name="todo")
     */
    public function todoAction()
    {
        $todos = $this->getDoctrine()->getRepository('AppBundle:Todo')->findAll();
        
        return $this->render('todo.html.twig', [
            'todos' => $todos
        ]);
    }
}
