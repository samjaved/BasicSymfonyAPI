<?php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class BuildingRepository extends EntityRepository
{
    public function getAll()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT building.buildingid,building.moveindate,building.street,building.postcode,building.town,building.country FROM AppBundle:Buildings building '
            )
            ->getResult();
    }

    public function findTokenById($id)
    {
        /*return $this->getEntityManager()
            ->createQuery(
                'SELECT building.token FROM AppBundle:Buildings building Where building.id='$id)
            ->getResult();*/
        $result = $this->createQueryBuilder('Buildings')
            ->select('Buildings.token')
            ->where('Buildings.id =:id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();

        return $result['token'];


    }


}

?>
