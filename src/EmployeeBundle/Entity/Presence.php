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
 * Presence
 *
 * @ORM\Table(name="Presence")
 * @ORM\Entity
 *
 */
class Presence
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idPresence", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idPresence;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    protected $date;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=30, nullable=false)
     */
    protected $status;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=30, nullable=false)
     */
    protected $lieu;

    /**
     * @var integer
     *
     * @ORM\Column(name="montant_day", type="integer", nullable=true)
     *
     */
    protected $montantDay;

    /**
     * @var integer
     *
     * @ORM\Column(name="day", type="integer", nullable=true)
     *
     */
    protected $Day;

    /**
     * @return int
     */
    public function getDay()
    {
        return $this->Day;
    }

    /**
     * @param int $Day
     */
    public function setDay($Day)
    {
        $this->Day = $Day;
    }
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
     * @return Week
     */
    public function getIdWeek()
    {
        return $this->idWeek;
    }

    /**
     * @param Week $idWeek
     */
    public function setIdWeek($idWeek)
    {
        $this->idWeek = $idWeek;
    }



    /**
     * @var Week
     *
     * @ORM\ManyToOne(targetEntity="Week")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idWeek", referencedColumnName="idWeek")
     * })
     */
    protected $idWeek;




    /**
     * Presence constructor.
     * @param int $idPresence
     */
    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getIdPresence()
    {
        return $this->idPresence;
    }

    /**
     * @param int $idPresence
     */
    public function setIdPresence($idPresence)
    {
        $this->idPresence = $idPresence;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * @param string $lieu
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
    }

    /**
     * @return int
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * @param int $montant
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;
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

    /**
     * @return int
     */
    public function getMontantDay()
    {
        return $this->montantDay;
    }

    /**
     * @param int $montantDay
     */
    public function setMontantDay($montantDay)
    {
        $this->montantDay = $montantDay;
    }




}