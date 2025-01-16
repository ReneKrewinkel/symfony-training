<?php

namespace App\Controller;

use App\Service\ArtiestService;
use App\Service\OptredenService;
use App\Service\PoppodiumService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Psr\Log\LoggerInterface;

#[Route('/optreden')]
final class OptredenController extends AbstractController
{
    private OptredenService $os;

    private PoppodiumService $ps;
    private ArtiestService $as;


    public function __construct(OptredenService $os, PoppodiumService $ps, ArtiestService $as) {
       $this->os = $os;
       $this->ps = $ps;
         $this->as = $as;
    }

    #[Route('/', name: 'app_optreden_list')]
    public function index(): Response
    {
        $data = $this->os->fetchAllOptredens();
        return $this->render('optreden/index.html.twig', [
            'data' => $data,
        ]);
    }

    #[Route('/add', name: 'app_optreden_add')]
    public function addOptreden(): Response
    {
        $optreden = $this->os->newOptreden();
        return $this->render('optreden/add.html.twig',[
            'optreden' => $optreden,
            'poppodia' => $this->ps->fetchAllPoppodia(),
            'artiesten' => $this->as->fetchAllArtiesten()
        ]);
    }

    #[Route('/save', name: 'app_optreden_save')]
    public function saveOptreden(Request $request) {

        $data = $request->request->all();
        $result = $this->os->saveOptreden($data);
        return $this->redirectToRoute('app_optreden_list');
    }

    #[Route('/edit/{id}', name: 'app_optreden_edit')]
    public function editOptreden($id): Response
    {
        return $this->render('optreden/add.html.twig',[
            'optreden' => $this->os->fetchOptredenById($id),
            'poppodia' => $this->ps->fetchAllPoppodia(),
            'artiesten' => $this->as->fetchAllArtiesten()
        ]);
    }

}