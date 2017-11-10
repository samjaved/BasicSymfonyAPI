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
        $token = $data['emailGroup']['email'] . $data['country'] . $data['town'] . $data['postcode'] . $data['street'] . $data['moveindate'] . $data['buildingid'];
        //Converting Joined fields to base64 scheme to genrate access token which will be sent in the url through email to delete the record
        $access_token = base64_encode($token);
        $building->setToken($access_token);

        $em->persist($building);
        $em->flush();
        $this->sendEmail($building->getId(), $access_token, $data['emailGroup']['email']);

        $building->getId();
        return new JsonResponse('success : ' . $success);


    }

    public function sendEmail($id, $access_token, $email)
    {
        $url = "http://www.fbpredictor.com/assets/task_backend/web/Buildings/delete/id/" . $id . "/token/" . $access_token;

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

    /**
     * @Route("/delete/id/{id}/token/{token}")
     */
    public function deleteAction(Request $request, $id, $token)
    {
        $homepage = "http://www.google.com";
        //getting token from database on the basis of id
        $autheticated_token = $this->getDoctrine()
            ->getRepository(Buildings::class)
            ->findTokenById($id);
        //if Null token is received from database then already deleted record from database
        if ($autheticated_token == NULL) {
            // app/Resources/views/Messages/norecord.html.twig
            return $this->render('Messages/norecord.html.twig',
                array('homepage' => $homepage));

        } //if token in the url request and token received on the basis of id in the url request are equal then authenticated request
        else if ($token == $autheticated_token) {
            $em = $this->getDoctrine()->getEntityManager();
            $adminentities = $em->getRepository('AppBundle:Buildings')->find($id);

            $em->remove($adminentities);
            $em->flush();
            // app/Resources/views/Messages/delete.html.twig
            return $this->render('Messages/delete.html.twig',
                array('homepage' => $homepage));

        } else {
            //Unauthenticated request
            // app/Resources/views/Messages/unauthenticated.html.twig
            return $this->render('Messages/unauthenticated.html.twig',
                array('homepage' => $homepage));
        }

    }

}

?>