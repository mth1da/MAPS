<?php

namespace App\Controller;

use App\Entity\Sandwich;
use App\Form\PickRandomSandwichFormType;
use App\Repository\IngredientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RandomSandwichController extends AbstractController
{
    #[Route('/random/sandwich', name: 'app_random_sandwich')]
    public function index(Request $request, IngredientRepository $ingredientRepository): Response
    {
        $sandwich = new Sandwich();

        $randomForm = $this->createForm(PickRandomSandwichFormType::class);
        $randomForm->handleRequest($request);

        if($randomForm->isSubmitted() && $randomForm->isValid()){

            //on parcourt le form
            foreach ($randomForm->getData() as $key => $ingredient ){
                //si l'user a coché tel type d'ingrédient
                if ($key){

                    //on
                    $ingredientRepository->findOneRandomlyBySlug($key);

                    dd($ingredientRepository->findOneRandomlyBySlug($key));

                    $sandwich = $randomForm->get($key);
                }
            }
            dd($sandwich);
        }

        return $this->render('random_sandwich/pick_random.html.twig', [
            'pickRandomSandwichForm' => $randomForm->createView()
        ]);
    }
}
