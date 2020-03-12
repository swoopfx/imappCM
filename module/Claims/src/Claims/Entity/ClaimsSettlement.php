<?php
namespace Claims\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * This class is an Entity for settled claims
 * Defining date of settlement, amount and date paid if possible
 *
 * @ORM\Entity
 * @ORM\Table(name="claims_settlement")
 * @author otaba
 *        
 */
class ClaimsSettlement
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
     * @ORM\OneToOne(targetEntity="CLaims", inversedBy="claimsSettled")
     * @var CLaims
     */
    private $claims;

    /**
     *
     * @ORM\Column(name="amount_approved", type="string", nullable=true)
     * @var string
     */
    private $amountApproved;

    /**
     *
     * @ORM\Column(name="information", type="text", nullable=true)
     * @var string
     */
    private $information;

    /**
     * This is the date the claim was approved
     *
     * @ORM\Column(name="date_approved", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $dateApproved;

    /**
     *
     * @ORM\ManyToMany(targetEntity="GeneralServicer\Entity\Document")
     * @ORM\JoinTable(name="claims_settled_doc",
     * joinColumns={@ORM\JoinColumn(name="claims", referencedColumnName="id")},
     * inverseJoinColumns={@ORM\JoinColumn(name="doc", referencedColumnName="id")}
     * )
     * This is a series of document associated to this claims
     * available to the customer but uploaded by the admin/broker
     *
     * @var Collection
     */
    private $document;

    /**
     *
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $createdOn;

    /**
     *
     * @ORM\Column(name="updated_on", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updateOn;

    // TODO - Insert your code here
    public function __construct()
    {
        $this->document = new ArrayCollection();
    }

    /**
     *
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @return \Claims\Entity\CLaims
     */
    public function getClaims()
    {
        return $this->claims;
    }

    /**
     *
     * @return string
     */
    public function getAmountApproved()
    {
        return $this->amountApproved;
    }

    /**
     *
     * @return string
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     *
     * @return DateTime
     */
    public function getDateApproved()
    {
        return $this->dateApproved;
    }

    /**
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     *
     * @return DateTime
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     *
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     *
     * @param \Claims\Entity\CLaims $claims
     */
    public function setClaims($claims)
    {
        $this->claims = $claims;
        return $this;
    }

    /**
     *
     * @param string $amountApproved
     */
    public function setAmountApproved($amountApproved)
    {
        $this->amountApproved = $amountApproved;
        return $this;
    }

    /**
     *
     * @param string $information
     */
    public function setInformation($information)
    {
        $this->information = $information;
        return $this;
    }

    /**
     *
     * @param DateTime $dateApproved
     */
    public function setDateApproved($dateApproved)
    {
        $this->dateApproved = $dateApproved;
        return $this;
    }

    /**
     *
     * @param \Doctrine\Common\Collections\Collection $document
     */
    public function addDocument($document)
    {
        if (! $this->document->contains($document)) {
            $this->document[] = $document;
        }

        return $this;
    }

    public function removeDocument($document)
    {
        if($this->document->contains($document)){
            $this->document->removeElement($document);
        }
        return $this;
    }

    /**
     *
     * @param \DateTime $createdOn
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;
        return $this;
    }
    /**
     * @return \DateTime
     */
    public function getUpdateOn()
    {
        return $this->updateOn;
    }

    /**
     * @param \DateTime $updateOn
     */
    public function setUpdateOn($updateOn)
    {
        $this->updateOn = $updateOn;
        return $this;
    }

}

