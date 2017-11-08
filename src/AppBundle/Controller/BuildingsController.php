<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Buildings;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityRepository;

/**
 * @Route("/Buildings")
 */
class BuildingsController extends Controller
{
    /**
     * @Route("/insert")
     * @Method("POST")
     */
    public function insertAction(Request $request)
    {
        $success=true;
        header("Access-Control-Allow-Origin: *");
        $data = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getEntityManager();
        $building = new Buildings();
        $building->setMoveindate($data['moveindate']);
        $building->setStreet($data['street']);
        $building->setPostcode($data['postcode']);
        $building->setTown($data['town']);
        $building->setCountry($data['country']);
        $building->setEmail($data['emailGroup']['email']);


        $em->persist($building);
        $em->flush();

        return new JsonResponse('success : '.$success);


    }
    /**
     * @Route("/list")
     */
    public function listAction()
    {
        $products = $this->getDoctrine()
            ->getRepository(Buildings::class)
            ->getAll();
        return new JsonResponse($products);
    }
}

?>