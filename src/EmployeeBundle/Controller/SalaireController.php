<?php

namespace EmployeeBundle\Controller;

use EmployeeBundle\Entity\Salaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Salaire controller.
 *
 */
class SalaireController extends Controller
{
    /**
     * Lists all salaire entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $salaires = $em->getRepository('EmployeeBundle:Salaire')->findAll();

        return $this->render('salaire/index.html.twig', array(
            'salaires' => $salaires,
        ));
    }

    /**
     * Creates a new salaire entity.
     *
     */
    public function newAction(Request $request)
    {
        $salaire = new Salaire();
        $form = $this->createForm('EmployeeBundle\Form\SalaireType', $salaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($salaire);
            $em->flush();

            return $this->redirectToRoute('salaire_show', array('idSalaire' => $salaire->getIdsalaire()));
        }

        return $this->render('salaire/new.html.twig', array(
            'salaire' => $salaire,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a salaire entity.
     *
     */
    public function showAction(Salaire $salaire)
    {
        $deleteForm = $this->createDeleteForm($salaire);

        return $this->render('salaire/show.html.twig', array(
            'salaire' => $salaire,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing salaire entity.
     *
     */
    public function editAction(Request $request, Salaire $salaire)
    {
        $deleteForm = $this->createDeleteForm($salaire);
        $editForm = $this->createForm('EmployeeBundle\Form\SalaireType', $salaire);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('salaire_edit', array('idSalaire' => $salaire->getIdsalaire()));
        }

        return $this->render('salaire/edit.html.twig', array(
            'salaire' => $salaire,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a salaire entity.
     *
     */
    public function deleteAction(Request $request, Salaire $salaire)
    {
        $form = $this->createDeleteForm($salaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($salaire);
            $em->flush();
        }

        return $this->redirectToRoute('salaire_index');
    }

    /**
     * Creates a form to delete a salaire entity.
     *
     * @param Salaire $salaire The salaire entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Salaire $salaire)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('salaire_delete', array('idSalaire' => $salaire->getIdsalaire())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
