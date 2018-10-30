<?php
/**
 * Created by PhpStorm.
 * User: Amir
 * Date: 30-Oct-18
 * Time: 3:34 PM
 */

namespace EmployeeBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Salaire
 *
 * @ORM\Table(name="Salaire")
 * @ORM\Entity
 *
 */
class Salaire
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idSalaire", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idSalaire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datePayment", type="date", nullable=true)
     */
    protected $datePayment;

    /**
     * @var integer
     *
     * @ORM\Column(name="montant", type="integer", nullable=true)
     *
     */
    protected $montantweek;

    /**
     * @var integer
     *
     * @ORM\Column(name="montantweek", type="integer", nullable=true)
     *
     */
    protected $avance;

    /**
     * @var Employee
     *
     * @ORM\ManyToOne(targetEntity="Employee")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idEmployee", referencedColumnName="idEmployee")
     * })
     */
    protected $idEmployee;

    /**
     * @var Week
     *
     * @ORM\ManyToOne(targetEntity="Week")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idWeek", referencedColumnName="idWeek")
     * })
     */
    protected $idWeek;


    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getIdSalaire()
    {
        return $this->idSalaire;
    }

    /**
     * @param int $idSalaire
     */
    public function setIdSalaire($idSalaire)
    {
        $this->idSalaire = $idSalaire;
    }

    /**
     * @return \DateTime
     */
    public function getDatePayment()
    {
        return $this->datePayment;
    }

    /**
     * @param \DateTime $datePayment
     */
    public function setDatePayment($datePayment)
    {
        $this->datePayment = $datePayment;
    }

    /**
     * @return int
     */
    public function getMontantweek()
    {
        return $this->montantweek;
    }

    /**
     * @param int $montantweek
     */
    public function setMontantweek($montantweek)
    {
        $this->montantweek = $montantweek;
    }

    /**
     * @return int
     */
    public function getAvance()
    {
        return $this->avance;
    }

    /**
     * @param int $avance
     */
    public function setAvance($avance)
    {
        $this->avance = $avance;
    }

    /**
     * @return Employee
     */
    public function getIdEmployee()
    {
        return $this->idEmployee;
    }

    /**
     * @param Employee $idEmployee
     */
    public function setIdEmployee($idEmployee)
    {
        $this->idEmployee = $idEmployee;
    }







}