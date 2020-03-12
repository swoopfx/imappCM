<?php
namespace Proposal\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * Object
 *
 * @ORM\Table(name="proposal_comment")
 * @ORM\Entity
 */
class ProposalComment
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\Column(name="comment", type="text", nullable=true)
     * @var string
     */
    private $comment;
    
    /**
     * @ORM\ManyToOne(targetEntity="Proposal")
     * @ORM\JoinColumn(name="proposal_id", referencedColumnName="id")
     * @var Proposal
     */
    private $proposal;
    
    /**
     *
     * @var \DateTime @ORM\Column(name="created_on", type="datetime", nullable=true)
     */
    private $createdOn;
    
    /**
     *
     * @var \DateTime @ORM\Column(name="updated_on", type="datetime", nullable=true)
     */
    private $updatedOn;
    
    

    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }
}

