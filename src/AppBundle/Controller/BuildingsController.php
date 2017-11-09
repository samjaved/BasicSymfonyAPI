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
        $success = true;
        header("Access-Control-Allow-Origin: *");
        //Receving all the posted data in json form and decoding it 
		$data = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getEntityManager();
        $building = new Buildings();
		//setting received data to enitiy fields accordingly
		$building->setBuildingid($data['buildingid']);
        $building->setMoveindate($data['moveindate']);
        $building->setStreet($data['street']);
        $building->setPostcode($data['postcode']);
        $building->setTown($data['town']);
        $building->setCountry($data['country']);
        $building->setEmail($data['emailGroup']['email']);
		//Joining all the received fields
        $token=$data['emailGroup']['email'].$data['country'].$data['town'].$data['postcode'].$data['street'].$data['moveindate'].$data['buildingid'];
		//Converting Joined fields to base64 scheme to genrate access token which will be sent in the url through email to delete the record
		$access_token=base64_encode($token);
		$building->setToken($access_token);
        
		$em->persist($building);
        $em->flush();
		$this->sendEmail($building->getId(),$access_token,$data['emailGroup']['email']);
        
		$building->getId();
        return new JsonResponse('success : ' . $success);


    }

    /**
     * @Route("/list")
     */
    public function listAction()
    {
        header("Access-Control-Allow-Origin: *");
		//Getting all the buiding data using custom repository function 
        $buildings = $this->getDoctrine()
            ->getRepository(Buildings::class)
            ->getAll();
		//returning the retrieved data in json form	
        return new JsonResponse($buildings);
    }
	
	
	public function sendEmail($id,$access_token,$email)
	{
		$url="http://www.fbpredictor.com/id/".$id."/token/".$access_token;
		
		$transport = $this->get('swiftmailer.transport.real');
       $mailer = \Swift_Mailer::newInstance($transport);
	  $message = (new \Swift_Message('Appartment Registration'))
        ->setFrom('sammar@fbpredictor.com')
        ->setTo($email)
        ->setBody(
		$this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                'Emails/registration.html.twig',
                array('url' => $url)
            ),
            'text/html'
		
		);
		$mailer->send($message);	
		
	}
	
}

?>