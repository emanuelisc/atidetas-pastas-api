<?php

namespace AppBundle\Controller;
 
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\User;
use AppBundle\Entity\vart_role;
use AppBundle\Entity\Role;
use AppBundle\Entity\Pranesimas;
use AppBundle\Entity\pran_vart;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Common\Collections\ArrayCollection;

class NotificationController extends FOSRestController
{

/**
     * @Rest\Get("/Notifications")
     */
    public function notificationAction()
    {
        //cia tik tikrinam, ar turi vartotojsa leidimus
        if(!function_exists('getallheaders'))
        {
         function getallheaders() 
         {
          foreach($_SERVER as $name => $value)
          {
           if(substr($name, 0, 5) == 'HTTP_')
           {
            $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
           }
          }
          return $headers;
         }
        }   
        $head = getallheaders();
        
        $em = $this->getDoctrine()->getManager();
        $member = $em->getRepository('AppBundle:User')->findOneBy(
            array('token' => $head['token'])
        );
        $vartroles = $member->getVart_roles();
         $role = 0;
         foreach ($vartroles as $vartrole){
            $rols = $vartrole->getRole()->getId();
            if($rols == 2)
                $role = 2;
         } 
        if ($role == 2){

            //Va cia tai kodas
            $zinutes = $member->getPran_varts();
            $zinute = array();
            $i = 0;
            foreach($zinutes as $vrole){
                $zinute[$i][0] = $this->getDoctrine()->getRepository('AppBundle:Pranesimas')->find($vrole->getPranesimas())->getTekstas();
                $zinute[$i][1] = $this->getDoctrine()->getRepository('AppBundle:Pranesimas')->find($vrole->getPranesimas())->getPavadinimas();
                $zinute[$i][2] = $this->getDoctrine()->getRepository('AppBundle:Pranesimas')->find($vrole->getPranesimas())->getData();
                $i++;
            }
            //return $zinute;
            $response = new Response();
            $response->setContent(json_encode([
                'zinute' => $zinute
            ]));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
    }

    else {
        return new View("You don't have permision!", Response::HTTP_NOT_FOUND);
    }
    }

    /**
     * @Rest\Post("/CreateMassMessage")
     */
    public function createMessageAction(Request $request)
    {
        //cia tik tikrinam, ar turi vartotojsa leidimus
        if(!function_exists('getallheaders'))
        {
         function getallheaders() 
         {
          foreach($_SERVER as $name => $value)
          {
           if(substr($name, 0, 5) == 'HTTP_')
           {
            $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
           }
          }
          return $headers;
         }
        }   
        $head = getallheaders();
        
        $em = $this->getDoctrine()->getManager();
        $member = $em->getRepository('AppBundle:User')->findOneBy(
            array('token' => $head['token'])
        );
        $vartroles = $member->getVart_roles();
         $role = 0;
         foreach ($vartroles as $vartrole){
            $rols = $vartrole->getRole()->getId();
            if($rols == 1 || $rols == 3)
                $role = 1;
         } 
        if ($role == 1){

            //Va cia tai kodas
            $settings = $em->getRepository('AppBundle:Pranesimas');
            $date = $request->get('send_date');
            $tema = $request->get('subject');
            $tekstas = $request->get('text');
                $data = new Pranesimas;
                $data->setTekstas($tekstas);
                $data->setPavadinimas($tema);
                $data->setData($date);
                $em->persist($data);
                $em->flush();
            $vart = $em->getRepository('AppBundle:User')->findAll();
            $pvrep = $em->getRepository('AppBundle:pran_vart');
            foreach ($vart as $user) {
                $pran_vart = new pran_vart;
                $pran_vart->setUser($user);
                $pran_vart->setPranesimas($data);
                $em->persist($pran_vart);
                
                
            }
            $em->flush();
            return new View("Message sent beautifully", Response::HTTP_OK);
        }
        else {
            return new View("You don't have permision!", Response::HTTP_NOT_FOUND);
        }
    }
}