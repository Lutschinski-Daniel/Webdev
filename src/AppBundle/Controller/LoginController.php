<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

class LoginController extends Controller {
    
     /**
     * @Route ("/login", name="login")
     */
    public function loginAction(){
        $user = new User();
        
        $form = $this->createFormBuilder($user)
            ->add('name', TextType::class)
            ->add('password', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Login'))
            ->getForm();

        return $this->render('login.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
    /**
     * @Route ("/register", name="register")
     */
    public function registerAction(){
        $user = new User();
        
        $form = $this->createFormBuilder($user)
            ->add('name', TextType::class)
            ->add('password', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Register'))
            ->getForm();

        return $this->render('register.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
