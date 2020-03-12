<?php
namespace GeneralServicer\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GeneratedRecurBill
 *
 * @ORM\Table(name="generated_recur_bill", indexes={@ORM\Index(name="FK_recurring_bill_offer_idx", columns={"offer_id"}), @ORM\Index(name="FK_recurring_bill_object_id_idx", columns={"object_id"})})
 * @ORM\Entity
 */
class GeneratedRecurBill
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
     * @var \DateTime @ORM\Column(name="recurring_date", type="datetime", nullable=false)
     */
    private $recurringDate;

    /**
     *
     * @var integer @ORM\Column(name="policy_id", type="integer", nullable=true)
     */
    private $policyId;

    /**
     *
     * @var integer @ORM\Column(name="created_date", type="integer", nullable=true)
     */
    private $createdDate;

    /**
     *
     * @var integer @ORM\Column(name="updated_date", type="integer", nullable=true)
     */
    private $updatedDate;

    /**
     *
     * @var string @ORM\Column(name="bill_value", type="decimal", precision=14, scale=2, nullable=true)
     */
    private $billValue;

    /**
     *
     * @var \Object\Entity\Object @ORM\ManyToOne(targetEntity="Object\Entity\Object")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="object_id", referencedColumnName="id")
     *      })
     */
    private $object;

    /**
     *
     * @var \Offer\Entity\Offer @ORM\ManyToOne(targetEntity="Offer\Entity\Offer")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="offer_id", referencedColumnName="id")
     *      })
     */
    private $offer;

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
     * Set recurringDate
     *
     * @param \DateTime $recurringDate            
     *
     * @return GeneratedRecurBill
     */
    public function setRecurringDate($recurringDate)
    {
        $this->recurringDate = $recurringDate;
        
        return $this;
    }

    /**
     * Get recurringDate
     *
     * @return \DateTime
     */
    public function getRecurringDate()
    {
        return $this->recurringDate;
    }

    /**
     * Set policyId
     *
     * @param integer $policyId            
     *
     * @return GeneratedRecurBill
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
     * Set createdDate
     *
     * @param integer $createdDate            
     *
     * @return GeneratedRecurBill
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
        
        return $this;
    }

    /**
     * Get createdDate
     *
     * @return integer
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Set updatedDate
     *
     * @param integer $updatedDate            
     *
     * @return GeneratedRecurBill
     */
    public function setUpdatedDate($updatedDate)
    {
        $this->updatedDate = $updatedDate;
        
        return $this;
    }

    /**
     * Get updatedDate
     *
     * @return integer
     */
    public function getUpdatedDate()
    {
        return $this->updatedDate;
    }

    /**
     * Set billValue
     *
     * @param string $billValue            
     *
     * @return GeneratedRecurBill
     */
    public function setBillValue($billValue)
    {
        $this->billValue = $billValue;
        
        return $this;
    }

    /**
     * Get billValue
     *
     * @return string
     */
    public function getBillValue()
    {
        return $this->billValue;
    }

    /**
     * Set object
     *
     * @param \All\Entity\Object $object            
     *
     * @return GeneratedRecurBill
     */
    public function setObject(\All\Entity\Object $object = null)
    {
        $this->object = $object;
        
        return $this;
    }

    /**
     * Get object
     *
     * @return \All\Entity\Object
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * Set offer
     *
     * @param \All\Entity\Offer $offer            
     *
     * @return GeneratedRecurBill
     */
    public function setOffer(\All\Entity\Offer $offer = null)
    {
        $this->offer = $offer;
        
        return $this;
    }

    /**
     * Get offer
     *
     * @return \All\Entity\Offer
     */
    public function getOffer()
    {
        return $this->offer;
    }
}
