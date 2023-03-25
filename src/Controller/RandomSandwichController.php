<?php

namespace App\Controller;

use App\Entity\Sandwich;
use App\Form\PickRandomSandwichFormType;
use App\Repository\IngredientRepository;
use App\Repository\SandwichRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RandomSandwichController extends AbstractController
{

    #[Route('/random/sandwich', name: 'app_random_sandwich')]
    public function index(Request $request, IngredientRepository $ingredientRepository, EntityManagerInterface $entityManager, SandwichRepository $sandwichRepository): Response
    {
        $RANDOM_SANDWICH_PRICE=3;

        $sandwich = new Sandwich();

        $randomForm = $this->createForm(PickRandomSandwichFormType::class);
        $randomForm->handleRequest($request);

        if($randomForm->isSubmitted() && $randomForm->isValid()){

            //on parcourt le form
            foreach ($randomForm->getData() as $key => $ingredient ){
                //si l'user a coché tel type d'ingrédient
                if (is_bool($ingredient) && $ingredient){
                    //on cherche randomly un ingrédient de ce type
                    $sandwich->addSandwichIngredient($ingredientRepository->findOneRandomlyBySlug($key));
                }
            }
            $sandwich->setName($randomForm->get('nom')->getData());
            $sandwich->setPrice($RANDOM_SANDWICH_PRICE);
            $entityManager->persist($sandwich);
            $entityManager->flush();

            $idSandwich = $sandwich->getId();


            return $this->render('random_sandwich/add_random.html.twig', [
                'randomSandwich' => $sandwichRepository->findById($idSandwich)
            ]);
            //return $this->redirectToRoute('app_random_sandwich_recap', array( 'id' => $sandwich->getId()));
        }

        return $this->render('random_sandwich/pick_random.html.twig', [
            'pickRandomSandwichForm' => $randomForm->createView()
        ]);
    }


    /*
    #[Route('/random/sandwich/{idSandwich}', name: 'app_random_sandwich_recap')]
    public function recap(SandwichRepository $sandwichRepository, int $idSandwich): Response
    {
        dd($idSandwich);
        return $this->render('random_sandwich/add_random.html.twig', [
            'randomSandwich' => $sandwichRepository->findById($idSandwich)
        ]);
    }*/
}
