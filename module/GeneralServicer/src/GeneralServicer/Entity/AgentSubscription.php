<?php
namespace GeneralServicer\Entity;

use Doctrine\ORM\Mapping as ORM;
use Users\Entity\InsuranceAgent;
use Settings\Entity\Packages;

/**
 *
 * @author swoopfx
 *         @ORM\Table(name="agent_subscription")
 *         @ORM\Entity
 */
class AgentSubscription
{

    /**
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="Users\Entity\InsuranceAgent")
     * @ORM\JoinColumn(name="agent_id", referencedColumnName="id")
     *
     * @var InsuranceAgent
     */
    private $agent;

    /**
     * @ORM\Column(name="start_date", type="date")
     *
     * @var \Date
     */
    private $startDate;

    /**
     * @ORM\Column(name="end_date", type="date")
     *
     * @var \Date
     */
    private $endDate;

    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\Packages")
     * @ORM\JoinColumn(name="package", referencedColumnName="id")
     *
     * @var Packages
     */
    private $package;

    public function getId()
    {
        return $this->id;
    }

    public function getAgent()
    {
        return $this->agent;
    }

    public function setAgent($id)
    {
        $this->agent = $id;
        
        return $this;
    }

    /**
     *
     * @return Date
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     *
     * @param \Date $date            
     */
    public function setStartDate($date)
    {
        $this->startDate = $date;
        return $this;
    }

    /**
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     *
     * @param \Date $end            
     */
    public function setEndDate($end)
    {
        $this->endDate = $end;
        
        return $this;
    }

    public function getPackage()
    {
        return $this->package;
    }

    public function setPackage($pack)
    {
        $this->package = $pack;
        
        return $this;
    }
}

?>