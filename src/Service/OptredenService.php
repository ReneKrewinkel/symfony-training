<?php

namespace App\Service;

use App\Entity\Artiest;
use App\Entity\Optreden;
use App\Entity\Poppodium;
use Doctrine\ORM\EntityManagerInterface;

class OptredenService {

    private $optredenRepo;
    private $artiestRepo;
    private $popRepo;

    public function __construct(EntityManagerInterface $em) {
        $this->optredenRepo = $em->getRepository(Optreden::class);
        $this->artiestRepo = $em->getRepository(Artiest::class);
        $this->popRepo = $em->getRepository(Poppodium::class);
    }


    private function fetchPoppodium($id) {
        return $this->popRepo->find($id);
    }

    private function fetchArtiest($id) {
        if($id == null) return null;
        return $this->artiestRepo->find($id);
    }

    public function fetchOptredenById($id) {
        return $this->optredenRepo->find($id);
    }

    public function saveOptreden($data) {
        $params = [
            "datum" => new \DateTime($data["datum"]),
            "prijs" => $data["prijs"],
            "ticketUrl" => $data["ticketUrl"],
            "hoofdprogramma" => $this->fetchArtiest($data["hoofdprogramma_id"]),
            "voorprogramma" => $this->fetchArtiest($data["voorprogramma_id"]),
            "poppodium" => $this->fetchPoppodium($data["poppodium_id"])
        ];

        $optreden = $this->optredenRepo->addOptreden($params);
        return($optreden);
    }

}