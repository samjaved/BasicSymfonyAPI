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
     * @Route("/buildings")
     */
class BuildingController extends Controller
{
    
	/**
     * @Route("api/list")
     */
	public function listAction()
{
        $products = $this->getDoctrine()
        ->getRepository(Buildings::class)
        ->getAll();
		return new JsonResponse( $products );
}
}
?>