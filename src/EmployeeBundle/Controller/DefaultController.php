<?php

namespace EmployeeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EmployeeBundle:Default:index.html.twig');
    }
}
