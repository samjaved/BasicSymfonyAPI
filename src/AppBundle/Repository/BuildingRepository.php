<?php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class BuildingRepository extends EntityRepository
{
    public function getAll()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT building.moveindate,building.street,building.postcode,building.town,building.country FROM AppBundle:Buildings building '
            )
            ->getResult();
    }
}

?>
