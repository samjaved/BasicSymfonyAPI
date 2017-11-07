<?php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class BuildingRepository extends EntityRepository
{
    public function getAll()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT building.street,building.moveindate FROM AppBundle:Buildings building '
            )
            ->getResult();
    }
}

?>
