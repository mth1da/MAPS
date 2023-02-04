<?php

namespace App\Controller;

use App\Entity\Publication;
use App\Form\PublicationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/publication', name: 'app_publication_')]
class PublicationController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index():Response{
        return $this->render('publication/index.html.twig');
    }

    #[Route('/ajout', name: 'add')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        //on crée une nouvelle publication
        $publi = new Publication();

        //on crée le formulaire
        $publiForm = $this->createForm(PublicationFormType::class, $publi);

        //on traite la requête du form
        $publiForm->handleRequest($request);

        //on vérifie si le form est soumis et valide
        if($publiForm->isSubmitted() && $publiForm->isValid()){
            $entityManager->persist($publi);
            $entityManager->flush();

            $this->addFlash('success', 'Produit ajouté avec succès');

            return $this->redirectToRoute('app_publication_index');
        }

        return $this->renderForm('publication/add.html.twig', [
            'publiForm' => $publiForm,
            ]);
        //<=>
        //return $this->render('publication/index.html.twig', [
        //    'publiForm' => $publiForm,
        //]);
    }

    #[Route('/modification', name: 'update')]
    public function update(Request $request, EntityManagerInterface $entityManager): Response
    {
        //on crée une nouvelle publication
        $publi = new Publication();

        //on crée le formulaire
        $publiForm = $this->createForm(PublicationFormType::class, $publi);

        //on traite la requête du form
        $publiForm->handleRequest($request);

        //on vérifie si le form est soumis et valide
        if($publiForm->isSubmitted() && $publiForm->isValid()){
            $entityManager->persist($publi);
            $entityManager->flush();

            $this->addFlash('success', 'Produit modifié avec succès');

            return $this->redirectToRoute('app_publication_index');
        }

        return $this->renderForm('publication/update.html.twig', [
            'publiForm' => $publiForm,
        ]);
    }
}
