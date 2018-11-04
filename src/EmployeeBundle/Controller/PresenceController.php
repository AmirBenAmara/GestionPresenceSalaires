<?php

namespace EmployeeBundle\Controller;

use EmployeeBundle\Entity\Presence;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Presence controller.
 *
 */
class PresenceController extends Controller
{
    /**
     * Lists all presence entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $presences = $em->getRepository('EmployeeBundle:Presence')->findAll();

        return $this->render('presence/index.html.twig', array(
            'presences' => $presences,
        ));
    }

    /**
     * Creates a new presence entity.
     *
     */
    public function newAction(Request $request)
    {
        $presence = new Presence();
        $form = $this->createForm('EmployeeBundle\Form\PresenceType', $presence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($presence);
            $em->flush();

            return $this->redirectToRoute('presence_show', array('idPresence' => $presence->getIdpresence()));
        }

        return $this->render('presence/new.html.twig', array(
            'presence' => $presence,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a presence entity.
     *
     */
    public function showAction(Presence $presence)
    {
        $deleteForm = $this->createDeleteForm($presence);

        return $this->render('presence/show.html.twig', array(
            'presence' => $presence,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing presence entity.
     *
     */
    public function editAction(Request $request, Presence $presence)
    {
        $deleteForm = $this->createDeleteForm($presence);
        $editForm = $this->createForm('EmployeeBundle\Form\PresenceType', $presence);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('presence_edit', array('idPresence' => $presence->getIdpresence()));
        }

        return $this->render('presence/edit.html.twig', array(
            'presence' => $presence,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a presence entity.
     *
     */
    public function deleteAction(Request $request, Presence $presence)
    {
        $form = $this->createDeleteForm($presence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($presence);
            $em->flush();
        }

        return $this->redirectToRoute('presence_index');
    }

    /**
     * Creates a form to delete a presence entity.
     *
     * @param Presence $presence The presence entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Presence $presence)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('presence_delete', array('idPresence' => $presence->getIdpresence())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
