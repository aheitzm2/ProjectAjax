<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Entity\Ville;
use App\Form\PhotoType;
use App\Form\VilleType;
use App\Service\FileUploader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/menu", name="Admin.menu")
     * @return \Symfony\Component\HttpFoundation\Response
     * @IsGranted("ROLE_USER")
     */
    public function index(){
        return $this->render("admin/menu.html.twig");
    }

    /**
     * @Route("/admin/ajout/ville", name="Admin.addVille")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @IsGranted("ROLE_USER")
     */
    public function ajoutVille(Request $request)
    {
        $ville= new Ville();
        $form = $this->createForm(VilleType::class, $ville);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $newVille=$form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($newVille);
            $em->flush();

            return $this->redirectToRoute('Home.index');
        }

        return $this->render('admin/ajoutVille.html.twig', ['form'=>$form->createView()]);
    }

    /**
     * @Route("/admin/ajout/photos", name="Admin.addPhoto")
     * @param Request $request
     * @param FileUploader $fileUploader
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @IsGranted("ROLE_USER")
     */
    public function ajoutPhoto(Request $request, FileUploader $fileUploader)
    {
        $photo= new Photo();
        $form = $this->createForm(PhotoType::class, $photo);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $newPhoto=$form->getData();
            /** @var UploadedFile $file */
            $file = $form->get('path')->getData();
            $fileName = $fileUploader->upload($file);
            $newPhoto->setPath($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($newPhoto);
            $em->flush();

            return $this->redirectToRoute('Home.index');
        }

        return $this->render('admin/ajoutPhoto.html.twig', ['form'=>$form->createView()]);
    }
}
