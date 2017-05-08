<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\User;
use AppBundle\Forms\LoginType;

class RegisterController extends Controller {

    /**
     * @Route ("/register", name="register")
     */
    public function registerAction(Request $request) {
        $user = new User();
        $form =  $this->createForm(LoginType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $repository = $this->getDoctrine()->getRepository('AppBundle:User');

            // check if user name already exists
            $em = $this->getDoctrine()->getManager();
            $userTmp = $repository->findOneBy(array('name' => $form->get('name')->getData()));

            // user name is free to use
            if ( empty($userTmp) ) {
                $user = $form->getData();
                $tmpPw = password_hash($form->get('password')->getData(), PASSWORD_DEFAULT);
                $user->setPassword($tmpPw);
                $em->persist($user);
                $em->flush();

                // notice to user that he is now registered
                $this->addFlash(
                        'notice', 'Welcome! You are now registered. Login if you\'d like.'
                );
                return $this->redirectToRoute('login');
            }
        }
        return $this->render('register.html.twig', [
                    'form' => $form->createView()
        ]);
    }

}
