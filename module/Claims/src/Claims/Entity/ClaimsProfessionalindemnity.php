<?php
namespace Claims\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="claims_professional_indemnity")
 * @author otaba
 *        
 */
class ClaimsProfessionalindemnity
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
     * Full name of the claimant or potential claimant
     * (i.e.
     * the party making the claim or potential claim a against you or the firm/company)
     *
     * @ORM\Column(name="claimnant_details", type="string", nullable=true)
     * @var string
     */
    private $claimnantDetails;

    /**
     * What claimnant was retained or contracted to do
     *
     * @ORM\Column(name="retainer_reason", nullable=true)
     * @var string
     */
    private $retainerReason;

    /**
     * Was your retainer/contract for services evidenced in writing
     * please attach a copy.
     * If not, please provide appropriate particulars
     * of the date of the retainer/contract and its terms
     *
     *  @ORM\Column(name="is_evidenced", type="boolean", nullable=true)
     * @var boolean
     */
    private $isEvidenced;

    /**
     * When was the work performed which the claim arise
     *
     * @ORM\Column(name="work_date", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $workDate;

    /**
     * Who is the person within the firm/company,
     * who actually performed the work or against whom the claim or
     * potential claim is principally directed?
     *
     * @ORM\Column(name="company_claim_principal", type="string", nullable=true)
     * @var string
     */
    private $companyClaimPrincipal;

    /**
     * What is that person’s title, duties and contact details
     *
     * @ORM\Column(name="principal_claim_title", nullable=true)
     * @var string
     */
    private $principalClaimTitle;

    /**
     * What is the precise nature of the claim
     * (i.e.
     * the claimant’s allegations) or the fact or circumstance that might give rise to a claim
     *
     *  @ORM\Column(name="claim_nature", type="text", nullable=true)
     * @var string
     */
    private $claimNature;

    /**
     * Have proceedings commenced? If so, please attach a copy of the court documents.
     *
     * @ORM\Column(name="is_proceeding",type="boolean", nullable=true)
     * @var boolean
     */
    private $isProceeding;

    /**
     * On what date did you first become aware of the claim or the fact or circumstance?
     *
     * @ORM\Column(name="claims_date", type="datetime", nullable=true)
     * @var \DateTime
     */
    private $claimDate;

    /**
     *
     * @ORM\Column(name="is_claims_in_writing", type="boolean", nullable=true)
     * @var boolean
     */
    private $isClaimsInWriting;

    /**
     *
     * @ORM\Column(name="claimnant_amount", nullable=true)
     * @var string
     */
    private $claimAmount;

    /**
     *
     * @ORM\Column(name="amount_details", type="text", nullable=true)
     * @var string
     */
    private $amountDetails;

    /**
     * What are your comments in response to the claim or the fact or
     * circumstance that might give rise to a claim?
     * What are your comments on the quantum of the claim and what is your estimate of your potential monetary
     * liability, if any, to the claimant?
     *
     * @ORM\Column(name="claims_fact_and_comment",type="text", nullable=true)
     * @var string
     */
    private $claimFactsNdComments;

    /**
     *
     * @ORM\Column(name="is_acting_solicitor", type="boolean", nullable=true)
     * @var boolean
     */
    private $isActinSolicitor;

    /**
     *
     * @ORM\Column(name="solicitor_details", type="text", nullable=true)
     * @var string
     */
    private $solicitorDetails;

    /**
     *
     * @ORM\OneToOne(targetEntity="Claims\Entity\CLaims", inversedBy="claimsProfessionalIndemnity")
     *
     * @var CLaims
     */
    private $claims;

    // TODO - Insert your code here
    public function __construct()
    {

        // TODO - Insert your code here
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
     * @return string
     */
    public function getClaimnantDetails()
    {
        return $this->claimnantDetails;
    }

    /**
     *
     * @return string
     */
    public function getRetainerReason()
    {
        return $this->retainerReason;
    }

    /**
     *
     * @return boolean
     */
    public function getIsEvidenced()
    {
        return $this->isEvidenced;
    }

    /**
     *
     * @return \DateTime
     */
    public function getWorkDate()
    {
        return $this->workDate;
    }

    /**
     *
     * @return string
     */
    public function getCompanyClaimPrincipal()
    {
        return $this->companyClaimPrincipal;
    }

    /**
     *
     * @return string
     */
    public function getPrincipalClaimTitle()
    {
        return $this->principalClaimTitle;
    }

    /**
     *
     * @return string
     */
    public function getClaimNature()
    {
        return $this->claimNature;
    }

    /**
     *
     * @return boolean
     */
    public function getIsProceeding()
    {
        return $this->isProceeding;
    }

    /**
     *
     * @return \DateTime
     */
    public function getClaimDate()
    {
        return $this->claimDate;
    }

    /**
     *
     * @return boolean
     */
    public function getIsClaimsInWriting()
    {
        return $this->isClaimsInWriting;
    }

    /**
     *
     * @return string
     */
    public function getClaimAmount()
    {
        return $this->claimAmount;
    }

    /**
     *
     * @return string
     */
    public function getAmountDetails()
    {
        return $this->amountDetails;
    }

    /**
     *
     * @return string
     */
    public function getClaimFactsNdComments()
    {
        return $this->claimFactsNdComments;
    }

    /**
     *
     * @return boolean
     */
    public function getIsActinSolicitor()
    {
        return $this->isActinSolicitor;
    }

    /**
     *
     * @return string
     */
    public function getSolicitorDetails()
    {
        return $this->solicitorDetails;
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
     * @param string $claimnantDetails
     */
    public function setClaimnantDetails($claimnantDetails)
    {
        $this->claimnantDetails = $claimnantDetails;
        return $this;
    }

    /**
     *
     * @param string $retainerReason
     */
    public function setRetainerReason($retainerReason)
    {
        $this->retainerReason = $retainerReason;
        return $this;
    }

    /**
     *
     * @param boolean $isEvidenced
     */
    public function setIsEvidenced($isEvidenced)
    {
        $this->isEvidenced = $isEvidenced;
        return $this;
    }

    /**
     *
     * @param \DateTime $workDate
     */
    public function setWorkDate($workDate)
    {
        $this->workDate = $workDate;
        return $this;
    }

    /**
     *
     * @param string $companyClaimPrincipal
     */
    public function setCompanyClaimPrincipal($companyClaimPrincipal)
    {
        $this->companyClaimPrincipal = $companyClaimPrincipal;
        return $this;
    }

    /**
     *
     * @param string $principalClaimTitle
     */
    public function setPrincipalClaimTitle($principalClaimTitle)
    {
        $this->principalClaimTitle = $principalClaimTitle;
        return $this;
    }

    /**
     *
     * @param string $claimNature
     */
    public function setClaimNature($claimNature)
    {
        $this->claimNature = $claimNature;
        return $this;
    }

    /**
     *
     * @param boolean $isProceeding
     */
    public function setIsProceeding($isProceeding)
    {
        $this->isProceeding = $isProceeding;
        return $this;
    }

    /**
     *
     * @param \DateTime $claimDate
     */
    public function setClaimDate($claimDate)
    {
        $this->claimDate = $claimDate;
        return $this;
    }

    /**
     *
     * @param boolean $isClaimsInWriting
     */
    public function setIsClaimsInWriting($isClaimsInWriting)
    {
        $this->isClaimsInWriting = $isClaimsInWriting;
        return $this;
    }

    /**
     *
     * @param string $claimAmount
     */
    public function setClaimAmount($claimAmount)
    {
        $this->claimAmount = $claimAmount;
        return $this;
    }

    /**
     *
     * @param string $amountDetails
     */
    public function setAmountDetails($amountDetails)
    {
        $this->amountDetails = $amountDetails;
        return $this;
    }

    /**
     *
     * @param string $claimFactsNdComments
     */
    public function setClaimFactsNdComments($claimFactsNdComments)
    {
        $this->claimFactsNdComments = $claimFactsNdComments;
        return $this;
    }

    /**
     *
     * @param boolean $isActinSolicitor
     */
    public function setIsActinSolicitor($isActinSolicitor)
    {
        $this->isActinSolicitor = $isActinSolicitor;
        return $this;
    }

    /**
     *
     * @param string $solicitorDetails
     */
    public function setSolicitorDetails($solicitorDetails)
    {
        $this->solicitorDetails = $solicitorDetails;
        return $this;
    }
    /**
     * @return \Claims\Entity\CLaims
     */
    public function getClaims()
    {
        return $this->claims;
    }

    /**
     * @param \Claims\Entity\CLaims $claims
     */
    public function setClaims($claims)
    {
        $this->claims = $claims;
        return $this;
    }

}

