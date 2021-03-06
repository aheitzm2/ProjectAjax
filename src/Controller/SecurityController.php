<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="Security.registration")
     */
    public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder){
        $user=new User();
        $form=$this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $hash=$encoder->encodePassword($user, $user->getPassword());

            $user->setPassword($hash);
            $user->setRoles("ROLE_USER");
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute("Security.login");
        }

        return $this->render('security/registration.html.twig',[
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/connexion", name="Security.login")
     */
    public function login(){
        return $this->render('security/login.html.twig');
    }

    /**
     * @Route("/déconnexion", name="Security.logout")
     */
    public function logout(){

    }
}