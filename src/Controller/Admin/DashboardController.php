<?php

namespace App\Controller\Admin;

use App\Dashboard\ConfigureDashboardEvent;
use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 * @Route("/admin")
 */
class DashboardController extends AbstractController
{
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var Environment
     */
    private $twig;

    public function __construct(EventDispatcherInterface $eventDispatcher, Environment $twig)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->twig = $twig;
    }

    /**
     * @Route("/dashboard", name="admin_dashboard_index")
     */
    public function index()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $aTasks = $this->getDoctrine()->getRepository(Task::class)->findAll();
        dd($aTasks);
        $dashboardItems = $this->eventDispatcher->dispatch(new ConfigureDashboardEvent($this->twig, ['aTasks'=> $aTasks]));
        
        return $this->render('admin/dashboard/index.html.twig', [
            'dashboardItems' => $dashboardItems,
        ]);
    }
}
