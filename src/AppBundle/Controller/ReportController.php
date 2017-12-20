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
            return new View("there are no orders yet", Response::HTTP_NOT_FOUND);
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
      $restresult = $this->getDoctrine()->getRepository('AppBundle:User')->findBy(array('uzsakymo_busena' => 1));
        if ($restresult === null) {
            return new View("there are no users exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
        return new JSonResponse(
            array('activeOrders' => count($restresult))
        );
    }

    /**
     * @Rest\Get("/Report/InActiveOrders")
     */
    public function getInActiveAction()
    {
      $restresult = $this->getDoctrine()->getRepository('AppBundle:User')->findBy(array('uzsakymo_busena' => 2));
        if ($restresult === null) {
            return new View("there are no users exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
        return new JSonResponse(
            array('activeOrders' => count($restresult))
        );
    }

    /**
     * @Rest\Get("/Report/ProcOrders")
     */
    public function getProcAction()
    {
      $restresult = $this->getDoctrine()->getRepository('AppBundle:User')->findBy(array('uzsakymo_busena' => 3));
        if ($restresult === null) {
            return new View("there are no users exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
        return new JSonResponse(
            array('activeOrders' => count($restresult))
        );
    }
}