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

// return new JSonResponse( 
//     array('meta' => array('code' => $myStatusCode,
//                           'message' => 'Your request failed because...'),
//           'data' => array('your datas')
//     ),
//     $myStatusCode
// );

class UserController extends FOSRestController
{
    /**
     * @Rest\Get("/user")
     */
    public function getAction()
    {
      $restresult = $this->getDoctrine()->getRepository('AppBundle:User')->findAll();
        if ($restresult === null) {
            return new View("there are no users exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
        // return new JSonResponse(
        //     array('rezultatas' => 'Your request failed because...')
        // );
    }

    /**
     * @Rest\Get("/user/{id}")
     */
    public function idAction($id)
    {
        $singleresult = $this->getDoctrine()->getRepository('AppBundle:User')->find($id);
        if ($singleresult === null) {
            return new View("user not found", Response::HTTP_NOT_FOUND);
        }
        return $singleresult;
    }
    
    /**
     * @Rest\Post("/user/")
     */
    public function postAction(Request $request)
    {
        $data = new User;
        $name = $request->get('name');
        $role = $request->get('role');
        if(empty($name) || empty($role)){
            return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE); 
        } 
        $data->setName($name);
        $data->setRole($role);
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
        return new View("User Added Successfully", Response::HTTP_OK);
    }

      /**
     * @Rest\Put("/user/{id}")
     */
    public function updateAction($id,Request $request)
    { 
        $data = new User;
        $name = $request->get('name');
        $role = $request->get('role');
        $sn = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine()->getRepository('AppBundle:User')->find($id);
        if (empty($user)) {
            return new View("user not found", Response::HTTP_NOT_FOUND);
        } 
        elseif(!empty($name) && !empty($role)){
        $user->setName($name);
        $user->setRole($role);
        $sn->flush();
            return new View("User Updated Successfully", Response::HTTP_OK);
        }
        elseif(empty($name) && !empty($role)){
            $user->setRole($role);
            $sn->flush();
            return new View("role Updated Successfully", Response::HTTP_OK);
        }
        elseif(!empty($name) && empty($role)){
            $user->setName($name);
            $sn->flush();
            return new View("User Name Updated Successfully", Response::HTTP_OK); 
        }
        else return new View("User name or role cannot be empty", Response::HTTP_NOT_ACCEPTABLE); 
    }

    /**
     * @Rest\Delete("/user/{id}")
     */
    public function deleteAction($id)
    {
        $data = new User;
        $sn = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine()->getRepository('AppBundle:User')->find($id);
        if (empty($user)) {
            return new View("user not found", Response::HTTP_NOT_FOUND);
        }
        else {
            $sn->remove($user);
            $sn->flush();
        }
        return new View("deleted successfully", Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/UserList2")
     */
    public function getUsersAction()
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

            //Va cia tai kodas
            $query = $em->createQuery("SELECT u.id, u.vardas, u.pavarde, u.pastas FROM AppBundle:User u");
            $users = $query->getResult();

            return $users;
        }
        else {
            return new View("You don't have permision!", Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @Rest\Get("/User/{id}")
     */
    public function userInfoAction($id)
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

            //Va cia tai kodas
            $singleresult = $this->getDoctrine()->getRepository('AppBundle:User')->find($id);
            if ($singleresult === null) {
                return new View("user not found", Response::HTTP_NOT_FOUND);
            }
            $miestas = $singleresult->getMiestas();
            if($miestas === null){
                $miestas = "nera";
            } else {
                $miestas = $this->getDoctrine()->getRepository('AppBundle:Miestas')->find($miestas)->getPavadinimas();
            }
            $vartrolesNaujas = $singleresult->getVart_roles();
            $role = array();
            $i = 0;
            foreach($vartrolesNaujas as $vrole){
                $role[$i] = $this->getDoctrine()->getRepository('AppBundle:Role')->find($vrole->getRole())->getPavadinimas();
                $i++;
            }
            //$roles = $query->getResult();
            $response = new Response();
            $response->setContent(json_encode([
                'vardas' => $singleresult->getVardas(),
                'pavarde' => $singleresult->getPavarde(),
                'pastas' => $singleresult->getPastas(),
                'adresas' => $singleresult->getAdresas(),
                "miestas" => $miestas,
                "role" => $role
            ]));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
    }

    else {
        return new View("You don't have permision!", Response::HTTP_NOT_FOUND);
    }
    }

    /**
     * @Rest\Get("/GetUserInfo")
     */
    public function userOwnInfoAction()
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
            if($rols == 2 || $rols == 1|| $rols == 1)
                $role = 2;
         } 
        if ($role == 2){

            //Va cia tai kodas
            $singleresult = $member;
            if ($singleresult === null) {
                return new View("user not found", Response::HTTP_NOT_FOUND);
            }
            $miestas = $singleresult->getMiestas();
            if($miestas === null){
                $miestas = "nera";
            } else {
                $miestas = $this->getDoctrine()->getRepository('AppBundle:Miestas')->find($miestas)->getPavadinimas();
            }
            $vartrolesNaujas = $singleresult->getVart_roles();
            $role = array();
            $i = 0;
            foreach($vartrolesNaujas as $vrole){
                $role[$i] = $this->getDoctrine()->getRepository('AppBundle:Role')->find($vrole->getRole())->getPavadinimas();
                $i++;
            }
            //$roles = $query->getResult();
            $response = new Response();
            $response->setContent(json_encode([
                'vardas' => $singleresult->getVardas(),
                'pavarde' => $singleresult->getPavarde(),
                'pastas' => $singleresult->getPastas(),
                'adresas' => $singleresult->getAdresas(),
                "miestas" => $miestas,
                "role" => $role
            ]));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
    }

    else {
        return new View("You don't have permision!", Response::HTTP_NOT_FOUND);
    }
    }

        /**
     * @Rest\Post("/User/Settings/Address")
     */
    public function setUserSettingAction(Request $request)
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
            $adresas = $request->get('adresas');
            $miesto_id = $request->get('miesto_id');
            $miestas = $em->getRepository('AppBundle:Miestas')->find($miesto_id);
            $member->setAdresas($adresas);
            $member->setMiestas($miestas);
            $em->flush();
            return new View("Settings Updated Successfully", Response::HTTP_OK);
        }
        else {
            return new View("You don't have permision!", Response::HTTP_NOT_FOUND);
        }
    }

        /**
     * @Rest\Get("/AdminList")
     */
    public function getAdminListAction()
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
            $vart_roles = $em->getRepository('AppBundle:vart_role')->findBy(array('role' => 1));
            return $vart_roles;
        }
        else {
            return new View("You don't have permision!", Response::HTTP_NOT_FOUND);
        }
    }


        /**
     * @Rest\Get("/UserList")
     */
    public function getUserListAction()
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
            $vart_roles = $em->getRepository('AppBundle:vart_role')->findBy(array('role' => 2));
            return $vart_roles;
        }
        else {
            return new View("You don't have permision!", Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @Rest\Get("/SupervisorList")
     */
    public function getSandelListAction()
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
            $vart_roles = $em->getRepository('AppBundle:vart_role')->findBy(array('role' => 3));
            return $vart_roles;
        }
        else {
            return new View("You don't have permision!", Response::HTTP_NOT_FOUND);
        }
    }
}