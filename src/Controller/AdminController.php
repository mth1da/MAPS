<?php

namespace App\Controller;

use phpDocumentor\Reflection\Types\Void_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 *@[Route('/admin', name: 'app_admin_')]
 */
class AdminController extends AbstractController
{
    /**
     *@[Route('/', name: 'index')]
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * Liste des utilisateurs du site
     * @route("/utilisateurs", name ="utilisateurs")
     */
    public function usersList(UsersRepository $users){
        return $this->render("admin/users.html.twig",[
            'users'=>$users->findAll()
            ]);
        }

    /**
     * Modifier un utilisateur
     * @route('/utilisateur/modifier/{id}', name "modifier_utilisateur")
     */
        public function editUser(Users $user, Request $request){
            $form = $this->createForm(EditUserType::class, $user);
            $form->handleRequest($request);

            if($form->isSUbmitted() && $form->isValid()){
                $entityManager= $this->getDoctrinr()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();

                $this->addFlash('message', 'Utilisateur modifié avec succès');
                return $this->redirectToRoute('admin_utilisateurs');
            }
            return $this->render('admin/edituser.html.twig', [
                'userForm'=>$form->createView()
            ]);


        }
    }
