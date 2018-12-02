<?php

namespace EmployeeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Created by PhpStorm.
 * User: Amir
 * Date: 30-Oct-18
 * Time: 1:13 PM
 */

/**
 * Employee
 *
 * @ORM\Table(name="Employee")
 * @ORM\Entity
 *
 */
class Employee
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idEmployee", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEmployee;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=30, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=30, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="CIN", type="string", length=30, nullable=false)
     */
    private $CIN;

    /**
     * @var string
     *
     * @ORM\Column(name="numTel", type="string", length=30, nullable=false)
     */
    private $numTel;

    /**
     * @var string
     *
     * @ORM\Column(name="SalaireJournalier", type="integer", nullable=true)
     */
    private $salaireJournalier;


    /**
     * Employee constructor.
     * @param int $idEmployee
     */
    public function __construct()
    {

    }

    /**
     * @return int
     */
    public function getIdEmployee()
    {
        return $this->idEmployee;
    }

    /**
     * @param int $idEmployee
     */
    public function setIdEmployee($idEmployee)
    {
        $this->idEmployee = $idEmployee;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return string
     */
    public function getCIN()
    {
        return $this->CIN;
    }

    /**
     * @param string $CIN
     */
    public function setCIN($CIN)
    {
        $this->CIN = $CIN;
    }

    /**
     * @return string
     */
    public function getNumTel()
    {
        return $this->numTel;
    }

    /**
     * @param string $numTel
     */
    public function setNumTel($numTel)
    {
        $this->numTel = $numTel;
    }

    /**
     * @return string
     */
    public function getSalaireJournalier()
    {
        return $this->salaireJournalier;
    }

    /**
     * @param string $salaireJournalier
     */
    public function setSalaireJournalier($salaireJournalier)
    {
        $this->salaireJournalier = $salaireJournalier;
    }


    function __toString()
    {
        return $this->getNom();
    }


}