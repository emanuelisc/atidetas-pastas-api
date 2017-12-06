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
     * @Rest\Post("/register")
     */
    public function registerAction(Request $request)
    {
        $data = new User;
        $vardas = $request->get('vardas');
        $pavarde = $request->get('pavarde');
        $pastas = $request->get('pastas');
        $slaptazodis = $request->get('slaptazodis');
        if(empty($vardas) || empty($pastas) || empty($slaptazodis)){
            return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE); 
        } 
        $length = 15;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $saugus = md5($slaptazodis);
        $data->setVardas($vardas);
        $data->setPavarde($pavarde);
        $data->setPastas($pastas);
        $data->setSlaptazodis($saugus);
        $data->setToken($randomString);
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
        return new View("User Added Successfully", Response::HTTP_OK);
    }
}