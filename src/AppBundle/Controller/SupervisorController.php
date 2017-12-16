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
use AppBundle\Entity\Settings;
use AppBundle\Entity\Darbas;
use Symfony\Component\HttpFoundation\JsonResponse;

class SupervisorController extends FOSRestController
{
    /**
     * @Rest\Get("/JobSchedule")
     */
    public function settingAction(Request $request)
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
            $darbai = $em->getRepository('AppBundle:Darbas')->findAll();
            if($darbai == null){
                return new View("There is no settings yet!", Response::HTTP_NOT_FOUND); 
            }
            else{
            return $darbai;
        }
    } else {
            return new View("You don't have permision!", Response::HTTP_NOT_FOUND);
        }
        
    }
}