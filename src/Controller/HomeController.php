<?php

namespace App\Controller;


use App\Entity\User;
use App\Entity\Ville;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
}
