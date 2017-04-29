<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegisterController extends Controller {
    
    /**
     * @Route ("/register", name="register")
     */
    public function registerAction(Request $request){
        $user = new User();
        
        $form = $this->createFormBuilder($user)
            ->add('name', TextType::class)
            ->add('password', PasswordType::class)
            ->add('save', SubmitType::class, array('label' => 'Register'))
            ->getForm();
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $repository = $this->getDoctrine()->getRepository('AppBundle:User');
            
            // check if user name already exists
            
            $em = $this->getDoctrine()->getManager();
            $userTmp = $repository->findOneBy(array('name' => $form->get('name')->getData()));
           
            if( empty($userTmp) ){
                $user = $form->getData();
                $em->persist($user);
                $em->flush();
            
                // notice to user that he is now registered
                $this->addFlash(
                    'notice',
                    'Welcome! You are now registered. Login if you\'d like.'
                );
                return $this->redirectToRoute('login');
            }
            // add "else" "Username already used!
        }

        return $this->render('login.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
