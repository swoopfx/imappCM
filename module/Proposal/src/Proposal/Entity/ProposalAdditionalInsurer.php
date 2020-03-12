<?php
namespace Proposal\Entity;


use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="proposal_additional_insurer")
 * @author swoopfx
 *        
 */
class ProposalAdditionalInsurer
{
    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    private $proposal;
    
    private $insurer;
    
    
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
}

