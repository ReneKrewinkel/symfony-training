<?php

namespace App\Repository;

use App\Entity\Artiest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Artiest>
 */
class ArtiestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Artiest::class);
    }

    public function saveArtiest($data): Artiest
    {
        if(isset($data["id"])) {
            $artiest = $this->find($data["id"]);
            if(!$artiest) {
                $artiest = new Artiest();
            }
        } else {
            $artiest = new Artiest();
        }

        $artiest->setNaam($data["naam"]);
        $artiest->setGenre($data["genre"]);

        $this->getEntityManager()->persist($artiest);

        dd($artiest);
       /// $this->getEntityManager()->flush();

        return $artiest;
    }

    public function deleteArtiest($id) {
        $artiest = $this->find($id);
        if($artiest) {
            $this->getEntityManager()->remove($artiest);
            $this->getEntityManager()->flush();
        }
    }

}
