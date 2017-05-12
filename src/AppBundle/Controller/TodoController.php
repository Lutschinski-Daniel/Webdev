<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Todo;
use AppBundle\Forms\TodoType;

class TodoController extends Controller
{
    /**
     * @Route ("/todo", name="todo")
     */
    public function todoAction(Request $request)
    {
        $todos = $this->getDoctrine()->getRepository('AppBundle:Todo')->findAll();
        
        $todo = new Todo();
        $form =  $this->createForm(TodoType::class, $todo);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $todo = $form->getData();
            
            if( $todo->getText() == null ){
                $todo->setText ('');
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($todo);
            $em->flush();
            
            return $this->redirectToRoute('todo');
        }
        
        return $this->render('todo.html.twig', [
            'todos' => $todos,
            'form' => $form->createView()
        ]);
    }
    
     /**
     * @Route ("/todo/delete", name="delete")
     */
    public function deleteAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $todo = $em->getRepository('AppBundle:Todo')->findOneBy(array('id' => $id));
        
        // Check if todo with id was found
        if( empty($todo) ){
            return $this->render('todo.html.twig');
        }
        $em->remove($todo);
        $em->flush();
 
        return new Response ('<h2>Deleted' . $id . '<h2>');
    }
}
