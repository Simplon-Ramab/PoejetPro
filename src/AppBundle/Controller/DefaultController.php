<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Evenement;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DefaultController extends Controller
{
  /**
   * Lists all livre entities.
   *
   * @Route("/", name="evenement_index_front")
   * @Method("GET")
   */
  public function EvenementAction()
  {
      $em = $this->getDoctrine()->getManager();

      $evenements = $em->getRepository('AppBundle:Evenement')->findAll();

      return $this->render('default/index.html.twig', array(
          'evenements' => $evenements,
      ));
  }

}
