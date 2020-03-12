<?php
namespace Users\Entity;

use Doctrine\ORM\Mapping as ORM;
use CsnUser\Entity\User;

/**
 *
 * @author swoopfx
 *         @ORM\Table(name="individual_profile")
 *         @ORM\Entity
 *        
 *        
 */
class IndividualProfile
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     *     
     */
    protected $id;

    /**
     *
     * @var User @ORM\OneToOne(targetEntity="CsnUser\Entity\User", inversedBy="individualProfile")
     *      @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *     
     */
    protected $user_id;

    protected $firstname;

    protected $lastname;

    protected $dob;
 // date of birth
    protected $created_on;

    protected $updated_on;

    /**
     *
     * @var IndividualContact @ORM\OneToMany(targetEntity="IndividualContact", mappedBy="individual_id")
     *     
     */
    protected $individualContact;
}

?>