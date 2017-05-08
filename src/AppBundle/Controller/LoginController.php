<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\User;
use AppBundle\Forms\LoginType;

class LoginController extends Controller {

    /**
     * @Route ("/login", name="login")
     */
    public function loginAction(Request $request) {
        $user = new User();
        $form =  $this->createForm(LoginType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();
            $repository = $this->getDoctrine()->getRepository('AppBundle:User');

            //check for valid user and password from db
            $userTmp = $repository->findOneBy(array('name' => $form->get('name')->getData()));
            
            // user doesn't exist
            if (empty($userTmp)) {
                return $this->render('login.html.twig', ['form' => $form->createView()]);
            }
            // user does exist, now check for valid pw
            $valid = password_verify($form->get('password')->getData(), $userTmp->getPassword());

            if ( $valid ) {
                // user is valid, save in session
                $session = $request->getSession();
                $session->set('username', $userTmp->getName());
                $session->set('user', $userTmp);

                // notice to user that he is logged in
                $this->addFlash(
                        'loggedin', 'Welcome ' . $userTmp->getName() . '! You are logged in now.'
                );
                // valid password for user
                return $this->redirectToRoute('options');
            } else {
                // invalid password for user
                return $this->render('login.html.twig', ['form' => $form->createView()]);
            }
        // form is not valid    
        } else {
            return $this->render('login.html.twig', [
                        'form' => $form->createView()
            ]);
        }
    }
}
