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



}