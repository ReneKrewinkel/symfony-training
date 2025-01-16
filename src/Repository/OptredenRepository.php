<?php

namespace App\Repository;

use App\Entity\Artiest;
use App\Entity\Optreden;
use App\Entity\Poppodium;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Optreden>
 */
class OptredenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Optreden::class);
    }


    public function fetchOptredenById($id) {
        return $this->find($id);
    }

    public function fetchByPrice($price) {
        return $this->findBy(['prijs' => $price], ['datum' => 'ASC']);
    }
    public function fetchAllOptredens() {
        return $this->findAll();
    }


    public function addOptreden($data) {
        $optreden = new Optreden();
        $optreden->setDatum($data["datum"]);
        $optreden->setPrijs($data["prijs"]);
        $optreden->setTicketUrl($data["ticketUrl"]);
        $optreden->setHoofdprogramma($data["hoofdprogramma"]);
        $optreden->setVoorprogramma($data["voorprogramma"]);
        $optreden->setPoppodium($data["poppodium"]);

        $this->getEntityManager()->persist($optreden);
        $this->getEntityManager()->flush();

        return $optreden;


    }

}
