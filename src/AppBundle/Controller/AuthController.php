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
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends FOSRestController
{
    /**
     * @Rest\Post("/login")
     */
    public function loginAction(Request $request)
    {
        $data = new User;

        $pastas = $request->get('pastas');
        $slaptazodis = $request->get('slaptazodis');
        if(empty($pastas) || empty($slaptazodis)){
            return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE); 
        } 
        $em = $this->getDoctrine()->getManager();
        $member = $em->getRepository('AppBundle:User')->findOneBy(
            array('pastas' => $pastas)
        );
        if($member == null){
            return new View("User does not exists", Response::HTTP_NOT_FOUND); 
        }
        else{
            if($member->getSlaptazodis() == md5($slaptazodis)){
                $response = new Response();
                $response->setContent(json_encode([
                    'id' => uniqid(),
                    'token' => $member->getToken()
                ]));
                $response->headers->set('Content-Type', 'application/json');
                // Allow all websites
                $response->headers->set('Access-Control-Allow-Origin', '*');
                return $response;
            }
            else{
                return new View("Wrong password", Response::HTTP_NOT_FOUND); 
            }
        }
    }

        /**
     * @Rest\Get("/testas")
     */
    public function testasAction(Request $request)
    {
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
        // $em = $this->getDoctrine()->getManager();
        // $member = $em->getRepository('AppBundle:User')->findOneBy(
        //     array('pastas' => $pastas)
        // );
        // if($member == null){
        //     return new View("User does not exists", Response::HTTP_NOT_FOUND); 
        // }
        // else{
             $response = new Response();
        //         $response->setContent(json_encode([
        //             'id' => uniqid(),
        //             'token' => $member->getToken()
        //         ]));
                 $response->headers->set('Content-Type', 'application/json');
        //         // Allow all websites
                     $response->headers->set('Access-Control-Allow-Origin', '*');
                     $response->headers->set('token', $head['token']);
                 return $response;
        // }

    
    }

    /**
     * @Rest\Post("/register")
     */
    public function registerAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $data = new User;
        $vardas = $request->get('vardas');
        $pavarde = $request->get('pavarde');
        $pastas = $request->get('pastas');
        $slaptazodis = $request->get('slaptazodis');
        if(empty($vardas) || empty($pastas) || empty($slaptazodis)){
            return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE); 
        } 
        $member = $em->getRepository('AppBundle:User')->findOneBy(
            array('pastas' => $pastas)
        );
        if($member != null){
            return new View("User already exists", Response::HTTP_NOT_FOUND); 
        }
        $length = 15;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $tikraRole = $this->getDoctrine()
        ->getRepository('AppBundle:Role')
        ->find(2);
        $role = new vart_role;
        $role->setRole($tikraRole);
        $role->setUser($data);

        $saugus = md5($slaptazodis);
        $data->setVardas($vardas);
        $data->setPavarde($pavarde);
        $data->setPastas($pastas);
        $data->setSlaptazodis($saugus);
        $data->setToken($randomString);
        
        $em->persist($data);
        $em->persist($role);
        $em->flush();
        return new View("User Added Successfully", Response::HTTP_OK);
    }



    //     /**
    //  * @Rest\Post("/update")
    //  */
    // public function updateAction(Request $request)
    // {
    //     $data = new User;
    //     $vardas = $request->get('vardas');
    //     $pavarde = $request->get('pavarde');
    //     $pastas = $request->get('pastas');
    //     $slaptazodis = $request->get('slaptazodis');
    //     if(empty($vardas) || empty($pastas) || empty($slaptazodis)){
    //         return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE); 
    //     } 
    //     $length = 15;
    //     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    //     $charactersLength = strlen($characters);
    //     $randomString = '';
    //     for ($i = 0; $i < $length; $i++) {
    //         $randomString .= $characters[rand(0, $charactersLength - 1)];
    //     }

    //     $role = new vart_role;
    //     $role->setUser();

    //     $saugus = md5($slaptazodis);
    //     $data->setVardas($vardas);
    //     $data->setPavarde($pavarde);
    //     $data->setPastas($pastas);
    //     $data->setSlaptazodis($saugus);
    //     $data->setToken($randomString);
    //     $em = $this->getDoctrine()->getManager();
    //     $em->persist($data);
    //     $em->flush();
    //     return new View("User Added Successfully", Response::HTTP_OK);
    // }
}