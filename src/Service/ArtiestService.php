<?php

namespace App\Service;

use App\Entity\Artiest;
use Doctrine\ORM\EntityManagerInterface;

class ArtiestService {

    private $artiestRepo;
    public function __construct(EntityManagerInterface $em) {
        $this->artiestRepo = $em->getRepository(Artiest::class);
    }

    public function fetchAllArtiesten() {
        return $this->artiestRepo->fetchAllArtiesten();
    }
}