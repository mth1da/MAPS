<?php

namespace App\Controller;

use App\Entity\Publication;
use App\Form\PublicationFormType;
use App\Service\UploadImageService;
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
    public function add(Request $request, EntityManagerInterface $entityManager, UploadImageService $uploadImgService): Response //DI
    {
        //on crée une nouvelle publication
        $publi = new Publication();

        //on crée le formulaire
        $publiForm = $this->createForm(PublicationFormType::class, $publi);

        //on traite la requête du form
        $publiForm->handleRequest($request);

        //on vérifie si le form est soumis et valide
        if($publiForm->isSubmitted() && $publiForm->isValid()){
            //on récupère l'user
            $user = $this->getUser();
            $publi->setPubliUser($user);

            //on récupère la photo
            $photo = $publiForm->get('photo')->getData();

            //on appelle le service upload image
            $fichier = $uploadImgService->create($photo,300,300);

            //on set le nom de fichier dans la bdd
            $publi->setPhoto($fichier);

            $entityManager->persist($publi);
            $entityManager->flush();

            $this->addFlash('success', 'Publication partagée avec succès.');

            return $this->redirectToRoute('app_feed');
        }

        return $this->render('publication/add.html.twig', [
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

            $this->addFlash('success', 'Publication partagée avec succès');

            return $this->redirectToRoute('app_publication_index');
        }

        return $this->render('publication/update.html.twig', [
            'publiForm' => $publiForm,
        ]);
    }
}
