<?php

namespace App\Controller;


use App\Entity\Partie;
use App\Entity\User;
use App\Entity\Ville;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="Home.index")
     * @Route("/vue/{route}", name="vue_index", requirements={"route"="^.+"})
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/ville/getAll", name="Ville.getAll")
     * @Route("/vue/{route}", name="vue_index", requirements={"route"="^.+"})
     */
    public function getAllVille(){
        $villes=$this->getDoctrine()->getRepository(Ville::class)->findAll();

        return $this->json(["villes"=>$villes]);
    }

    /**
     * @Route("/create/partie",name="Partie.create")
     * @Route("/vue/{route}", name="vue_index", requirements={"route"="^.+"})
     * @param Request $request
     * @param TokenGeneratorInterface $tgi
     * @param ObjectManager $manager
     */
    public function createPartie(Request $request, TokenGeneratorInterface $tgi, ObjectManager $manager){
        $token=$tgi->generateToken();
        $pseudo=$request->get("pseudo");
        $difficulte=$request->get("difficulte");
        $ville=$request->get("ville");

        $ville=$manager->getRepository(Ville::class)->findOneBy(['nom'=>$ville]);

        $partie=new Partie();
        $partie->setToken($token);
        $partie->setPseudo($pseudo);
        $partie->setDifficulte($difficulte);
        $partie->setVille($ville);

        $manager->persist($partie);
        $manager->flush();

        return $this->json(["partie"=>$partie]);
    }
}
