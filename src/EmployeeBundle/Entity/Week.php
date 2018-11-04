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
 * week
 *
 * @ORM\Table(name="Week")
 * @ORM\Entity
 *
 */
class Week
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idWeek", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idWeek;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="date", nullable=true)
     */
    protected $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date", nullable=true)
     */
    protected $dateFin;

    function __toString()
    {
       return (string)$this->idWeek;
    }


    /**
     * @return int
     */
    public function getIdWeek()
    {
        return $this->idWeek;
    }

    /**
     * @param int $idWeek
     */
    public function setIdWeek($idWeek)
    {
        $this->idWeek = $idWeek;
    }

    /**
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * @param \DateTime $dateDebut
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * @param \DateTime $dateFin
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    }



}