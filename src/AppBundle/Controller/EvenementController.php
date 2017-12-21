<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Evenement;
use AppBundle\Entity\Utilisateur;
use AppBundle\Entity\Categorie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * Evenement controller.
 *
 * @Route("evenement")
 */
class EvenementController extends Controller
{
    /**
     * Lists all evenement entities.
     *
     * @Route("/", name="evenement_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $evenements = $em->getRepository('AppBundle:Evenement')->findAll();

        return $this->render('evenement/index.html.twig', array(
            'evenements' => $evenements,
        ));
    }

    /**
     * Creates a new evenement entity.
     * @Security("has_role('ROLE_USER')")
     * @Route("/new", name="evenement_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $evenement = new Evenement();
        $evenement->setUtilisateur($this ->container->get('security.token_storage')->getToken()->getUser());
        $form = $this->createForm('AppBundle\Form\EvenementType', $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            // $file contient l'image nouvellement uploadée
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $evenement->getFile();

            // Génération d'un nom unique pour l'image (pour éviter les collisions à l'enregistrement)
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // Déplacement l'image dans le dossier
            $file->move(
                $evenement->getCoverUploadDirectory(),
                $fileName
            );

            // On met à jour la propriété cover
            $evenement->setCover($fileName);

            $em->persist($evenement);
            $em->flush();

            return $this->redirectToRoute('evenement_show', array('id' => $evenement->getId()));
        }

        return $this->render('evenement/new.html.twig', array(
            'evenement' => $evenement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a evenement entity.
     *
     * @Route("/{id}", name="evenement_show")
     * @Method("GET")
     */
    public function showAction(Evenement $evenement)
    {
        $deleteForm = $this->createDeleteForm($evenement);

        return $this->render('evenement/show.html.twig', array(
            'evenement' => $evenement,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing evenement entity.
     * @Security("has_role('ROLE_USER')")
     * @Route("/{id}/edit", name="evenement_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Evenement $evenement)
    {
        $deleteForm = $this->createDeleteForm($evenement);
        $editForm = $this->createForm('AppBundle\Form\EvenementType', $evenement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('evenement_edit', array('id' => $evenement->getId()));
        }

        return $this->render('evenement/edit.html.twig', array(
            'evenement' => $evenement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a evenement entity.
     * @Security("has_role('ROLE_USER')")
     * @Route("/{id}", name="evenement_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Evenement $evenement)
    {
        $form = $this->createDeleteForm($evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($evenement);
            $em->flush();
        }

        return $this->redirectToRoute('evenement_index');
    }

    /**
     * Creates a form to delete a evenement entity.
     *
     * @param Evenement $evenement The evenement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Evenement $evenement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('evenement_delete', array('id' => $evenement->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Inscription à un evenements.
     * @Security("has_role('ROLE_USER')")
     * @Route("/{id}/add", name="inscrire", requirements={"id": "\d+"})
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Evenement $evenement
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
     public function Participer(Request $request, Evenement $evenement)

     {
         $editForm = $this->createForm('AppBundle\Form\EvenementType', $evenement);
         $editForm->setData($evenement->addParticipant(
             $this->container
             ->get('security.token_storage')
             ->getToken()
             ->getUser()
         ));
         $editForm->handleRequest($request);
         if ($editForm->isSubmitted() && $editForm->isValid() &&
             count($evenement->getParticipants()) <= $evenement->getPlace()) {
             $em = $this->getDoctrine()->getManager();
             $em->flush();
             return $this->redirectToRoute('evenement_index');
         }
         return $this->render('evenement/show_add_event.html.twig', array(
             'evenements' => $evenement,
             'edit_form' => $editForm->createView(),
         ));
     }

     /**
      * Inscription à un evenements.
       * @Security("has_role('ROLE_USER')")
      * @Route("/{id}/supprimer", name="desinscrire", requirements={"id": "\d+"})
      * @Method({"GET", "POST"})
      * @param Request $request
      * @param Evenement $evenement
      * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
      */
      public function Desinscrire(Request $request, Evenement $evenement)

      {
          $editForm = $this->createForm('AppBundle\Form\EvenementType', $evenement);
          $editForm->setData($evenement->removeParticipant(
              $this->container
              ->get('security.token_storage')
              ->getToken()
              ->getUser()
          ));
          $editForm->handleRequest($request);
          if ($editForm->isSubmitted() && $editForm->isValid() &&
              count($evenement->getParticipants()) <= $evenement->getPlace()) {
              $em = $this->getDoctrine()->getManager();
              $em->flush();
              return $this->redirectToRoute('evenement_index');
          }
          return $this->render('evenement/show_remove_event.html.twig', array(
              'evenements' => $evenement,
              'edit_form' => $editForm->createView(),
          ));
      }


      /**
       * Lists all categorie entities.
       *
       * @Route("/", name="recherche_index")
       * @Method("GET")
       */
      public function rechercheAction()
      {
          $em = $this->getDoctrine()->getManager();
          $motcle = $request ->get('motcle');

          $repository = $em->getRepository('AppBundle:Evenement')->findAll();

          return $this->render('evenement/index.html.twig', array(
              'evenements' => $evenements,
          ));
      }

}
