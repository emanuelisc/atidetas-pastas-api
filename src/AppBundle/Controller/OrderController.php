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
use AppBundle\Entity\Uzsakymas;
use AppBundle\Entity\perdavimo_tipas;
use AppBundle\Entity\Siuntinys;
use Symfony\Component\HttpFoundation\JsonResponse;

class OrderController extends FOSRestController
{
    /**
     * @Rest\Get("/AllOrders")
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
            if($rols == 1 || $rols == 3) //jei tai adminas arba sandelininkas
                $role = 1;
        } 
        if ($role == 1){
            $uzsakymai = $em->getRepository('AppBundle:Uzsakymas')->findAll();
            if($uzsakymai == null){
                return new View("There is no orders yet!", Response::HTTP_NOT_FOUND); 
            }
            else{
            return $uzsakymai;
        }
    } else {
            return new View("You don't have permision!", Response::HTTP_NOT_FOUND);
        }
        
    }

    /**
     * @Rest\Get("/OrderList")
     */
    public function orderListAction(Request $request)
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
            if($rols == 2 ) //jei tai adminas arba sandelininkas
                $role = 2;
        }
        if ($role == 2){

            $query = $em->createQuery("SELECT u.gavejoAdresas, u.siuntejoAdresas, u.gavimoData FROM AppBundle:Uzsakymas u WHERE u.vartotojas = ".$member->getId());
            $uzsakymai = $query->getResult();
//            $uzsakymai = $em->getRepository('AppBundle:Uzsakymas')->findOneBy(
//                array('gavejoAdresas' => "Kaunas")
//            );
                    //array('vartotojo_id' => $member)
           // );
            if(empty($uzsakymai)){
                return new View("There is no orders yet!", Response::HTTP_NOT_FOUND);
            }
            else{
//                $response = new Response();
//                $response->setContent(json_encode([
//                    'orders' => $uzsakymai->getGavejoAdresas(),
//                ]));
//                $response->headers->set('Content-Type', 'application/json');
//                return $response;
                return $uzsakymai;
            }
        } else {
            return new View("You don't have permision!", Response::HTTP_NOT_FOUND);
        }

    }


    /**
     * @Rest\Post("/CreateOrder")
     */
    public function createOrderAction(Request $request)
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


            $receiver_address=$request->get('receiver_address');
            $sender_address=$request->get('sender_address');
            $receive_date = $request->get('receive_date');
            $parcel_transfer_to_warehouse_type=$request->get('parcel_transfer_to_warehouse_type');
            $height=$request->get('height');
            $width=$request->get('width');
            $length=$request->get('length');
            $weight=$request->get('weight');

            if(empty($receiver_address) || empty($sender_address) || empty($receive_date)||empty($parcel_transfer_to_warehouse_type)||empty($height) || empty($width) || empty($length)||empty($weight)){
                return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE);
            }


            $siuntinys = new Siuntinys();
            $siuntinys->setAukstis($height);
            $siuntinys->setPlotis($width);
            $siuntinys->setIlgis($length);
            $siuntinys->setSvoris($weight);

            $perdavimas = $this->getDoctrine()
                ->getRepository('AppBundle:perdavimo_tipas')
                ->find($parcel_transfer_to_warehouse_type);
            $uzsakymas = new Uzsakymas();
            $uzsakymas->setGavejoAdresas($receiver_address);
            $uzsakymas->setSiuntejoAdresas($sender_address);
            $uzsakymas->setGavimoData($receive_date);
            $uzsakymas->setUzsakymoData(date("Y-m-d H:i:s"));
            $uzsakymas->setPerdavimoTipas($perdavimas);
            $uzsakymas->setVartotojas($member);
            $em->persist($uzsakymas);

            $em->flush();
            //$siuntinys->setUzsakymas();

            //return new View("Order Added Successfully", Response::HTTP_OK);



        }
        else {
            return new View("You don't have permision!", Response::HTTP_NOT_FOUND);
        }
    }



    /**
     * @Rest\Get("/WarehouseList")
     */
    public function warehouseListAction(Request $request)
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
            if($rols == 1 ) //jei tai adminas arba sandelininkas
                $role = 1;
        }
        if ($role == 1){

            $query = $em->createQuery("SELECT u.gavejoAdresas, u.siuntejoAdresas, u.gavimoData FROM AppBundle:Uzsakymas u LEFT  JOIN AppBundle:Siuntinys s WITH u.id = s.uzsakymas WHERE s.yraSandelyje = 1");
            $uzsakymai = $query->getResult();
//            $uzsakymai = $em->getRepository('AppBundle:Uzsakymas')->findOneBy(
//                array('gavejoAdresas' => "Kaunas")
//            );
            //array('vartotojo_id' => $member)
            // );
            if(empty($uzsakymai)){
                return new View("There is no orders yet!", Response::HTTP_NOT_FOUND);
            }
            else{
//                $response = new Response();
//                $response->setContent(json_encode([
//                    'orders' => $uzsakymai->getGavejoAdresas(),
//                ]));
//                $response->headers->set('Content-Type', 'application/json');
//                return $response;
                return $uzsakymai;
            }
        } else {
            return new View("You don't have permision!", Response::HTTP_NOT_FOUND);
        }

    }

}