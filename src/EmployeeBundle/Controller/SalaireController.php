<?php

namespace EmployeeBundle\Controller;

use EmployeeBundle\Entity\Week;
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
     * Lists all Current salaire entities.
     *
     */
    public function indexCurrentAction()
    {
        $em = $this->getDoctrine()->getManager();

        $salaires = $em->getRepository('EmployeeBundle:Salaire')->findBy(array('idWeek' => $this->getCurrentWeek()->getIdWeek()));


        return $this->render('salaire/indexCurrent.html.twig', array(
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
            //return $this->redirectToRoute('salaire_edit', array('idSalaire' => $salaire->getIdsalaire()));
            $salaires = $this->getDoctrine()->getManager()->getRepository('EmployeeBundle:Salaire')->findBy(array('idWeek' => $this->getCurrentWeek()->getIdWeek()));


            return $this->render('salaire/indexCurrentAjaxRefresh.html.twig', array(
                'salaires' => $salaires,
            ));
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




    /**
     * Finds and displays a salaire entity.
     *
     */
    public function payAction(Salaire $salaire)
    {

        $salaire->setIsPaid("payé");
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        return $this->redirectToRoute('salaire_index_current');
    }




    public function getCurrentWeek(){
        $currentWeek = $this->getDoctrine()->getManager()
            ->createQuery('SELECT w FROM EmployeeBundle:Week w ORDER BY w.idWeek DESC')
            ->setMaxResults(1)->getOneOrNullResult();
        return $currentWeek;
    }

    public function newSalarySheetAction(){

        $this->newWeek();
        $this->GenerateNewSalariesForAllEmployees();
        return $this->redirectToRoute('salaire_index_current');
    }


    private function GenerateNewSalariesForAllEmployees() {
        $newWeek = $this->getCurrentWeek();
        $em = $this->getDoctrine()->getManager();
        $employees = $em->getRepository('EmployeeBundle:Employee')->findAll();
        $batchSize = 4;
        for ($i = 1; $i <= sizeof($employees); ++$i) {
            $salaire = new Salaire();
            $salaire->setIdEmployee($employees[$i-1]);
            $salaire->setIdWeek($newWeek);
            $salaire->setAvance(0);
            $salaire->setDatePayment($this->getCurrentWeek()->getDateFin());
            $salaire->setMontantweek(0);
            $salaire->setIsPaid("pas encore payé");
            $em->persist($salaire);

            if (($i % $batchSize) === 0) {
                $em->flush();
                $em->clear(); // Detaches all objects from Doctrine!
            }
        }

        $em->flush(); // Persist objects that did not make up an entire batch
        $em->clear();
    }


    private function newWeek()
    {
        $lastWeek = $this->getCurrentWeek();
        $week = new Week();
        $date1=$lastWeek->getDateDebut();
        $date2=$lastWeek->getDateFin();
        $newStartDate = $date2->modify('+1 day');
        $newEndDate = $date1->modify('+13 day');
        $week->setDateDebut($newStartDate);
        $week->setDateFin($newEndDate);
            $em = $this->getDoctrine()->getManager();
            $em->persist($week);
            $em->flush();

    }



}
