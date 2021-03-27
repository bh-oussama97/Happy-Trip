<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Hotel;
use App\Entity\Reclamation;
use App\Entity\User;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
      $routeBuilder = $this->get(AdminUrlGenerator::class);

      return $this->redirect($routeBuilder->setController(ReclamationCrudController::class)->generateUrl());
    }

    public function configureMenuItems(): iterable {
      yield MenuItem::section('Management');
      yield MenuItem::linkToCrud('Hotels', 'fas fa-hotel', Hotel::class);
      yield MenuItem::linkToCrud('Reclamations', 'fas fa-ban', Reclamation::class);
      yield MenuItem::linkToCrud('Users', 'fa fa-user', User::class);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Happy Trip <i class = "fa fa-plane"></i>');
    }
}
