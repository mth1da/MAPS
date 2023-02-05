<?php

namespace App\Controller\Admin;

use App\Entity\Ingredient;
use App\Entity\Sandwich;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator){

    }
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        $url = $this->adminUrlGenerator
            ->setController(IngredientCrudController::class)
            ->generateUrl();

        return$this->redirect($url);

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Maps');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Ingrédients');
        yield MenuItem::section('Clients');
        yield MenuItem::section('Reservation');
        yield MenuItem::section('Publication');
        yield MenuItem::section('Sandwichs');
        yield MenuItem::section('Table');

        yield MenuItem::subMenu('Action Ingredient', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Create Ingredient', 'fas fa-plus', Ingredient::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Ingredient', 'fas fa-eye', Ingredient::class)
        ]);
        yield MenuItem::subMenu('Action Sandwich', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Create Sandwich', 'fas fa-plus', Sandwich::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Sandwich', 'fas fa-eye', Sandwich::class)
        ]);
        yield MenuItem::subMenu('Action User', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Create User', 'fas fa-plus', User::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show User', 'fas fa-eye', User::class)
        ]);



        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
