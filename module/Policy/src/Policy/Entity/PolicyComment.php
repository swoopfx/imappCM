<?php
namespace Policy\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PolicyComment
 *
 * @ORM\Table(name="policy_comment")
 * @ORM\Entity
 */
class PolicyComment
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     *
     * @var string @ORM\Column(name="comment", type="text", nullable=true)
     */
    private $comment;

    /**
     *
     * @var integer @ORM\Column(name="policy_id", type="integer", nullable=true)
     */
    private $policyId;

    /**
     *
     * @var string @ORM\Column(name="date_created", type="string", length=100, nullable=true)
     */
    private $dateCreated;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set comment
     *
     * @param string $comment            
     *
     * @return PolicyComment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
        
        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set policyId
     *
     * @param integer $policyId            
     *
     * @return PolicyComment
     */
    public function setPolicyId($policyId)
    {
        $this->policyId = $policyId;
        
        return $this;
    }

    /**
     * Get policyId
     *
     * @return integer
     */
    public function getPolicyId()
    {
        return $this->policyId;
    }

    /**
     * Set dateCreated
     *
     * @param string $dateCreated            
     *
     * @return PolicyComment
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;
        
        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return string
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }
}
