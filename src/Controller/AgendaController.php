<?php

namespace App\Controller;

use App\Entity\Optreden;
use App\Entity\Artiest;
use App\Service\OptredenService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AgendaController extends AbstractController
{

    private $optredenRepo;
    private $artiestRepo;
    private $optredenService;

    public function __construct(EntityManagerInterface $em, OptredenService $os)
    {
        $this->optredenRepo = $em->getRepository(Optreden::class);
        $this->artiestRepo = $em->getRepository(Artiest::class);
        $this->optredenService = $os;
    }

    #[Route('/agenda', name: 'app_agenda')]
    public function index(): Response
    {

        $data = $this->optredenRepo->fetchAllOptredens();

        return $this->render('agenda/index.html.twig', [
            'data' => $data,
        ]);
    }

    #[Route('/agenda/show/{id}', name: 'app_agenda_detail')]
    public function detail($id): Response
    {
        $data = $this->optredenRepo->fetchOptredenById($id);
        dd($data);

    }

    #[Route('/artiest/add', name: 'app_artiest_add')]
    public function addArtiest(): Response {
        $data = [
            "id" => 4,
            "naam" => "The Beatles",
            "genre" => "Rock"
        ];
        $artiest = $this->artiestRepo->saveArtiest($data);
        dd($artiest);
    }

    #[Route('/artiest/delete/{id}', name: 'app_artiest_delete')]
    public function deleteArtiest($id): Response {
        $this->artiestRepo->deleteArtiest($id);
        return $this->redirectToRoute('app_agenda');
    }

    #[Route('/optreden/add', name: 'app_optreden_add')]
    public function addOptreden() {
        $data = [
            "poppodium_id" => 1,
            "voorprogramma_id" => 3,
            "hoofdprogramma_id" => 1,
            "datum" => "2025-04-01",
            "prijs" => 2500,
            "ticketUrl" => "https://www.ticketmaster.nl"
        ];

        $data = $this->optredenService->saveOptreden($data);
        return $this->redirectToRoute('app_agenda');
    }
}
