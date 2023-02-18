<?php

namespace App\Controller\Admin;

use App\Entity\Ingredient;
use App\Entity\Type;
use App\Entity\Reservation;
use App\Entity\Sandwich;
use App\Entity\User;
use App\Entity\Table;
use App\Entity\Order;
use App\Entity\Publication;
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
    #[Route('/admin', name: 'app_admin')]
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

        yield MenuItem::linktoRoute('Back to the website', 'fas fa-home', 'app_homepage');

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
        yield MenuItem::subMenu('Action Table', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Create Table', 'fas fa-plus', Table::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Table', 'fas fa-eye', Table::class)
        ]);
        yield MenuItem::subMenu('Action Publication', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Create Publication', 'fas fa-plus', Publication::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Publication', 'fas fa-eye', Publication::class)
        ]);
        yield MenuItem::subMenu('Action Order', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Create Order', 'fas fa-plus', Order::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Order', 'fas fa-eye', Order::class)
        ]);
        yield MenuItem::subMenu('Action Reservation', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Create Reservation', 'fas fa-plus', Reservation::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Reservation', 'fas fa-eye', Reservation::class)
        ]);
        yield MenuItem::subMenu('Action Type ', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Create Type', 'fas fa-plus', Type::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Type', 'fas fa-eye', Type::class)
        ]);


        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
