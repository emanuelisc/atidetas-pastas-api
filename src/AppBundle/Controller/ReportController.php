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
use AppBundle\Entity\Uzsakymas;
use Symfony\Component\HttpFoundation\JsonResponse;

// return new JSonResponse( 
//     array('meta' => array('code' => $myStatusCode,
//                           'message' => 'Your request failed because...'),
//           'data' => array('your datas')
//     ),
//     $myStatusCode
// );

class ReportController extends FOSRestController
{
    /**
     * @Rest\Get("/Report/AllOrders")
     */
    public function getAction()
    {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:Uzsakymas')->findAll();
        if ($restresult === null) {
            return new JSonResponse(
                array('allorders' => 0)
            );
        }
        return new JSonResponse(
            array('allorders' => count($restresult))
        );
    }

        /**
     * @Rest\Get("/Report/ActiveOrders")
     */
    public function getActiveAction()
    {
      $restresult = $this->getDoctrine()->getRepository('AppBundle:Uzsakymas')->findBy(array('uzsakymo_busena' => 1));
        if ($restresult === null) {
            return new JSonResponse(
                array('activeOrders' => 0)
            );
        }
        return new JSonResponse(
            array('activeOrders' => count($restresult))
        );
    }

    /**
     * @Rest\Get("/Report/InActiveOrders")
     */
    public function getInActiveAction()
    {
      $restresult = $this->getDoctrine()->getRepository('AppBundle:Uzsakymas')->findBy(array('uzsakymo_busena' => 2));
        if ($restresult === null) {
            return new JSonResponse(
                array('activeOrders' => 0)
            );
        }
        return new JSonResponse(
            array('activeOrders' => count($restresult))
        );
    }

    /**
     * @Rest\Get("/Report/ProcOrders")
     */
    public function getProcAction()
    {
      $restresult = $this->getDoctrine()->getRepository('AppBundle:Uzsakymas')->findBy(array('uzsakymo_busena' => 3));
        if ($restresult === null) {
            return new JSonResponse(
                array('activeOrders' => 0)
            );
        }
        return new JSonResponse(
            array('activeOrders' => count($restresult))
        );
    }
    /**
     * @Rest\Get("/Report/FinishedOrdersReport")
     */
    public function getFinProcAction()
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
            if($rols == 1)
                $role = 1;
         } 
        if ($role == 1){
        $restresult = $this->getDoctrine()->getRepository('AppBundle:Uzsakymas')->findBy(array('uzsakymo_busena' => 3));
        if ($restresult === null) {
            return new JSonResponse(
                array('activeOrders' => "Špyga tau!")
            );
        }
        $margin = $em->getRepository('AppBundle:Settings')->find(1)->getMargin();
        $suma = 0;
        for ($in = 0; $in < count($restresult); $in++) {
            $suma = $suma + intval($margin) * count($restresult);
        }

        return new JSonResponse(
            array(
                'finOrders' => count($restresult),
                'suma' => $suma
            )
        );
    }
    
        else {
            return new View("You don't have permision!", Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @Rest\Get("/Report/Notifications")
     */
    public function getNotiAction()
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
            if($rols == 1)
                $role = 1;
         } 
        if ($role == 1){
        $restresult = $em->getRepository('AppBundle:Pranesimas')->findAll();
        if ($restresult === null) {
            return new JSonResponse(
                array('messages' => "0")
            );
        }
        $masyvas = array();
        $masI = 0;
        foreach($restresult as $pranesimas){
            $pran_varts = $pranesimas->getPran_varts();
            $pranid = $pranesimas->getId();
            $kiekis = 0;
            foreach ($pran_varts as $varts) {
                $kiekis++;
            }
            $masyvas[$masI] = array('pavadinimas' => $pranesimas->getPavadinimas(), 'kiekis' => $kiekis);
            $masI++;
        }
        return $masyvas;
        // return new JSonResponse(
        //     array(
        //         'name' => count($restresult),
        //         'suma' => $suma
        //     )
        // );
    }
    
        else {
            return new View("You don't have permision!", Response::HTTP_NOT_FOUND);
        }
    }
}