<?php

namespace EmployeeBundle\Controller;
use EmployeeBundle\Entity\Salaire;
use EmployeeBundle\Entity\Presence;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
     * Lists all Current Dqy Presence entities.
     *
     */
    public function indexCurrentAction()
    {
        $em = $this->getDoctrine()->getManager();

        $presences = $em->getRepository('EmployeeBundle:Presence')->findBy(array('date'=> new \DateTime()));

        return $this->render('presence/indexCurrent.html.twig', array(
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


/*

    public function editAjaxAction(Request $request,Presence $presence)
    {
        //This is optional. Do not do this check if you want to call the same action using a regular request.
        if (!$request->isXmlHttpRequest()) {
            return new JsonResponse(array('message' => 'You can access this only using Ajax!'), 400);
        }
        $editForm = $this->createForm('EmployeeBundle\Form\PresenceType', $presence,   array(
            'action' => $this->generateUrl('demo_create'),
            'method' => 'POST',
        ));

        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return new JsonResponse(array('message' => 'Success!'), 200);
        }

        $response = new JsonResponse(
            array(
                'message' => 'Error',
                'form' => $this->renderView('AcmeDemoBundle:Demo:form.html.twig',
                    array(
                        'entity' => $entity,
                        'form' => $form->createView(),
                    ))), 400);

        return $response;
    }
*/

    /**
     * Displays a form to edit an existing presence entity.
     *
     */
    public function editAjaxAction(Request $request, Presence $presence)
    {
        $currentPresence =clone $presence;
        //$deleteForm = $this->createDeleteForm($presence);
        $em = $this->getDoctrine()->getManager();
        $editForm = $this->createForm('EmployeeBundle\Form\PresenceType', $presence);
        $editForm->handleRequest($request);


        if ($editForm->isSubmitted() && $editForm->isValid()) {


            $currentSalaire = $em->getRepository('EmployeeBundle:Salaire')->findOneBy(array('idWeek'=> $presence->getIdWeek()->getIdWeek(),
                'idEmployee'=>$presence->getIdEmployee()->getIdEmployee()));

            //echo($currentSalaire);

            // if new
            if($currentPresence->getMontantDay()===0) {
                $montant=$presence->getMontantDay();
                $currentSalaire->setMontantweek($presence->getMontantDay());
                //var_dump("new".$montant);
            }
            // if edit or wrong
            else {
                $montant=$presence->getMontantDay()-$currentPresence->getMontantDay();
                $currentSalaire->setMontantweek($montant);
               // var_dump("edit".$montant);
            }

            //var_dump($currentSalaire);

            $em->merge($currentSalaire);
            $em->flush();

            $presences = $em->getRepository('EmployeeBundle:Presence')->findBy(array('date'=> new \DateTime()));


            return $this->render('presence/indexCurrentAjaxRefresh.html.twig', array(
                'presences' => $presences,

            ));
        }

        return $this->render('presence/edit.html.twig', array(
            'presence' => $presence,
            'edit_form' => $editForm->createView(),
          //  'delete_form' => $deleteForm->createView(),
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


    /**
     * Returns the new generated Presence Sheets
     */
    public function newPresenceSheetAction(){


        $this->GenerateNewPresencesForAllEmployees();
        return $this->redirectToRoute('presence_index');
    }

    /**
     * Generates a new Presence sheet for all Employees
     */
    private function GenerateNewPresencesForAllEmployees() {
        $em = $this->getDoctrine()->getManager();
        $employees = $em->getRepository('EmployeeBundle:Employee')->findAll();
        $batchSize = 4;
        for ($i = 1; $i <= sizeof($employees); ++$i) {
            $presence = new Presence();
            $presence->setIdEmployee($employees[$i-1]);
            $presence->setLieu("");
            $presence->setDate(new \DateTime());
            $presence->setMontant(0);
            $presence->setMontantDay(0);
            $presence->setStatus("");
            $presence->setIdWeek($this->getCurrentWeek());


            $em->persist($presence);

            if (($i % $batchSize) === 0) {
                $em->flush();
                $em->clear(); // Detaches all objects from Doctrine!
            }
        }

        $em->flush(); // Persist objects that did not make up an entire batch
        $em->clear();    }


    public function getCurrentWeek(){
        $currentWeek = $this->getDoctrine()->getManager()
            ->createQuery('SELECT w FROM EmployeeBundle:Week w ORDER BY w.idWeek DESC')
            ->setMaxResults(1)->getOneOrNullResult();
        return $currentWeek;
    }
}
