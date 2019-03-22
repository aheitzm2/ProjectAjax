<?php

namespace App\Controller;


use App\Entity\Partie;
use App\Entity\Photo;
use App\Entity\User;
use App\Entity\Ville;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

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
     */
    public function getAllVille(){
        $villes=$this->getDoctrine()->getRepository(Ville::class)->findAll();

        return $this->json(['villes'=>$villes],Response::HTTP_OK, [], [
            ObjectNormalizer::GROUPS => ['ville'],
        ]);
    }

    /**
     * @Route("/create/partie",name="Partie.create")
     * @param Request $request
     * @param TokenGeneratorInterface $tgi
     * @param ObjectManager $manager
     * @return \Symfony\Component\HttpFoundation\JsonResponse
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

        return $this->json(["partie"=>$partie, "token"=>$token],Response::HTTP_OK, [], [
            ObjectNormalizer::GROUPS => ['partie'],
        ]);
    }

    /**
     * @Route("/ville/find",name="Ville.find")
     * @param Request $request
     * @param ObjectManager $manager
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function findVille(Request $request,ObjectManager $manager){
        $ville=$request->get('ville');
        $ville=$manager->getRepository(Ville::class)->findOneBy(['nom'=>$ville]);
        $photo=$manager->getRepository(Photo::class)->findBy(['ville'=>$ville]);
        dump($ville);
        return $this->json(['ville'=>$ville, 'photos'=>$photo],Response::HTTP_OK, [], [
            ObjectNormalizer::GROUPS => ['ville','photo'],
        ]);
    }
}
