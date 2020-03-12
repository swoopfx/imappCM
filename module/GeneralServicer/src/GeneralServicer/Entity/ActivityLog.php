<?php
namespace GeneralServicer\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * Activity Log
 * This  logs the user activity on the platform 
 * based on registeration , payment 
 * @ORM\Entity
 * @ORM\Table(name="activity_log")
 * @author swoopfx
 *        
 */
class ActivityLog
{
    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */

    private $id;
    
    private $user;
    
    private $activity;
    
    private $loggedOn;
    
    public function __construct()
    {}
}

