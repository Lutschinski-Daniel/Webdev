<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class LoginController extends Controller {
    
     /**
     * @Route ("/login", name="login")
     */
    public function loginAction(Request $request){
        
        // TODO testen ob user schon angemeldet ist. Falls ja, Optionen/Logout anzeigen.
        // Falls nein, form anzeigen.
        
        $user = new User();
        
        $form = $this->createFormBuilder($user)
            ->add('name', TextType::class)
            ->add('password', PasswordType::class)
            ->add('save', SubmitType::class, array('label' => 'Login'))
            ->getForm();
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $user = $form->getData();
            $repository = $this->getDoctrine()->getRepository('AppBundle:User');
            
            //check for valid user and password from db
            $userTmp = $repository->findOneBy(array('name' => $form->get('name')->getData()));
            
            if( !empty($userTmp) && ( $userTmp->getPassword() == $user->getPassword() ) ){
            
                // notice to user that he is logged in
                $this->addFlash(
                    'notice',
                    'Welcome back! You are logged in now.'
                );
        
                return $this->render('index.html.twig');
            }
        }

        return $this->render('login.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
