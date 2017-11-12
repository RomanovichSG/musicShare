<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\userType;
use AppBundle\Entity\user;

class userController extends Controller
{
    public function registrationAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new user();
        $form = $this->createForm(userType::class, $user)
            ->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $user=$form->getData();
            $password=$passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $datetime=new \DateTime();
            $user->setDateLastLogin($datetime);
            $user->setRole('ROLE_USER');
            $setUser=$this->getDoctrine()->getManager();
            $setUser->persist($user);
            $setUser->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('AppBundle:user:registration.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function loginAction(AuthenticationUtils $authUtils)
    {
        return $this->render('AppBundle:user:login.html.twig', array(
            'last_username' => $authUtils->getLastUsername(),
            'error' => $authUtils->getLastAuthenticationError()
        ));
    }

    public function logoutAction()
    {
        return $this->redirectToRoute('home');
    }


}
