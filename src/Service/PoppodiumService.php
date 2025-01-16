<?php

namespace App\Service;

use App\Entity\Poppodium;
use Doctrine\ORM\EntityManagerInterface;

class PoppodiumService {

    private $poppodiumRepo;
    public function __construct(EntityManagerInterface $em) {
        $this->poppodiumRepo = $em->getRepository(Poppodium::class);
    }

    public function fetchAllPoppodia() {
        return $this->poppodiumRepo->fetchAllPoppodia();
    }
}