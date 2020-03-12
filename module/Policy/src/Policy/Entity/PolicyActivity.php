<?php
namespace Policy\Entity;


use Doctrine\ORM\Mapping as ORM;
use Settings\Entity\PolicyActivityStatus;

/**
 * @ORM\Entity
 * @ORM\Table(name="policy_activity")
 * 
 * This activity logs the activity of the on a polcy 
 * @author otaba
 *
 */
class PolicyActivity
{
    
    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Policy", inversedBy="policyActivity")
     * @var Policy
     */
    private $policy;
    
    /**
     * @ORM\ManyToOne(targetEntity="Settings\Entity\PolicyActivityStatus")
     * @var PolicyActivityStatus
     */
    private $activityStatus;
    
    /**
     * @ORM\Column(name="activity_date", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $activityDate;
    
    /**
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $createdOn;

    // TODO - Insert your code here
    public function __construct()
    {

        // TODO - Insert your code here
    }
    /**
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \Policy\Entity\Policy
     */
    public function getPolicy()
    {
        return $this->policy;
    }

    /**
     * @return \Settings\Entity\PolicyActivityStatus
     */
    public function getActivityStatus()
    {
        return $this->activityStatus;
    }

    /**
     * @return \DateTime
     */
    public function getActivityDate()
    {
        return $this->activityDate;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param \Policy\Entity\Policy $policy
     */
    public function setPolicy($policy)
    {
        $this->policy = $policy;
        return $this;
    }

    /**
     * @param \Settings\Entity\PolicyActivityStatus $activityStatus
     */
    public function setActivityStatus($activityStatus)
    {
        $this->activityStatus = $activityStatus;return $this;
    }

    /**
     * @param \DateTime $activityDate
     */
    public function setActivityDate($activityDate)
    {
        $this->activityDate = $activityDate;
        return $this;
    }

    /**
     * @param \DateTime $createdOn
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;
        return $this;
    }

}

