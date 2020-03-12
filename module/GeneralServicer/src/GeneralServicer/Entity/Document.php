<?php
namespace GeneralServicer\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Document
 *
 * @ORM\Table(name="document", indexes={@ORM\Index(name="FK_document_doc_status_idx", columns={"doc_status"})})
 * @ORM\Entity
 * Please note that the offer, claims and policy mapping is unidirectional
 */
class Document
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
     * @var string @ORM\Column(name="doc_name", type="string", length=200, nullable=true)
     */
    private $docName;

    /**
     *
     * @var string @ORM\Column(name="doc_url", type="string", length=500, nullable=true)
     */
    private $docUrl;

    /**
     *
     * @var boolean @ORM\Column(name="is_confirmed", type="boolean", nullable=true)
     */
    private $isConfirmed = '0';

    /**
     *
     * @var \DateTime @ORM\Column(name="created_on", type="datetime", length=100, nullable=true)
     */
    private $createdOn;

    /**
     *
     * @var \DateTime @ORM\Column(name="updated_on", type="datetime", length=100, nullable=true)
     */
    private $updatedOn;

    /**
     *
     * @var boolean @ORM\Column(name="is_hidden", type="boolean", nullable=true)
     */
    private $isHidden;

    /**
     *
     * @var string @ORM\Column(name="mime_type", type="string", length=100, nullable=true)
     */
    private $mimeType;

    /**
     *
     * @var string @ORM\Column(name="doc_ext", type="string", length=45, nullable=true)
     */
    private $docExt;

    /**
     *
     * @var string @ORM\Column(name="doc_code", type="string", length=100, nullable=true)
     */
    private $docCode;

    /**
     *
     * @var \GeneralServicer\Entity\DocumentStatus @ORM\ManyToOne(targetEntity="GeneralServicer\Entity\DocumentStatus")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="doc_status", referencedColumnName="id")
     *      })
     */
    private $docStatus;
    
//     /**
//      * @var \Policy\Entity\Policy @ORM\ManyToOne(targetEntity="Policy\Entity\Policy", inversedBy="document")
//      *     
//      * @var Policy
//      */
//     private $policy;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Policy\Entity\CoverNote", inversedBy="coverNoteCert")
     * @var 
     */
    private $coverNote;

    /**
     * Constructor
     */
    public function __construct()
    {}

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
     * Set docName
     *
     * @param string $docName            
     *
     * @return Document
     */
    public function setDocName($docName)
    {
        $this->docName = $docName;
        
        return $this;
    }

    /**
     * Get docName
     *
     * @return string
     */
    public function getDocName()
    {
        return $this->docName;
    }

    /**
     * Set docPath
     *
     * @param string $docPath            
     *
     * @return Document
     */
    public function setDocUrl($docUrl)
    {
        $this->docUrl= $docUrl;
        
        return $this;
    }

    /**
     * Get docPath
     *
     * @return string
     */
    public function getDocUrl()
    {
        return $this->docUrl;
    }

    /**
     * Set isConfirmed
     *
     * @param boolean $isConfirmed            
     *
     * @return Document
     */
    public function setIsConfirmed($isConfirmed)
    {
        $this->isConfirmed = $isConfirmed;
        
        return $this;
    }

    /**
     * Get isConfirmed
     *
     * @return boolean
     */
    public function getIsConfirmed()
    {
        return $this->isConfirmed;
    }

    /**
     * Set createdOn
     *
     * @param string $createdOn            
     *
     * @return Document
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;
        $this->updatedOn = $createdOn;
        
        return $this;
    }

    /**
     * Get createdOn
     *
     * @return string
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * Set updatedOn
     *
     * @param string $updatedOn            
     *
     * @return Document
     */
    public function setUpdatedOn($updatedOn)
    {
        $this->updatedOn = $updatedOn;
        
        return $this;
    }

    /**
     * Get updatedOn
     *
     * @return string
     */
    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    /**
     * Set isHidden
     *
     * @param boolean $isHidden            
     *
     * @return Document
     */
    public function setIsHidden($isHidden)
    {
        $this->isHidden = $isHidden;
        
        return $this;
    }

    /**
     * Get isHidden
     *
     * @return boolean
     */
    public function getIsHidden()
    {
        return $this->isHidden;
    }

    /**
     * Set mimeType
     *
     * @param string $mimeType            
     *
     * @return Document
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;
        
        return $this;
    }

    /**
     * Get mimeType
     *
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * Set docExt
     *
     * @param string $docExt            
     *
     * @return Document
     */
    public function setDocExt($docExt)
    {
        $this->docExt = $docExt;
        
        return $this;
    }

    /**
     * Get docExt
     *
     * @return string
     */
    public function getDocExt()
    {
        return $this->docExt;
    }

    /**
     * Set docCode
     *
     * @param string $docCode            
     *
     * @return Document
     */
    public function setDocCode($docCode)
    {
        $this->docCode = $docCode;
        
        return $this;
    }

    /**
     * Get docCode
     *
     * @return string
     */
    public function getDocCode()
    {
        return $this->docCode;
    }

    /**
     * Set docStatus
     *
     * @param DocumentStatus $docStatus            
     *
     * @return Document
     */
    public function setDocStatus(DocumentStatus $docStatus = null)
    {
        $this->docStatus = $docStatus;
        
        return $this;
    }

    /**
     * Get docStatus
     *
     * @return DocumentStatus
     */
    public function getDocStatus()
    {
        return $this->docStatus;
    }

    /**
     * Get idOffer
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdOffer()
    {
        return $this->idOffer;
    }
    
    // /**
    // * Add idPolicy
    // *
    // * @param \All\Entity\Policy $idPolicy
    // *
    // * @return Document
    // */
    // public function addIdPolicy(\All\Entity\Policy $idPolicy)
    // {
    // $this->idPolicy[] = $idPolicy;
    
    // return $this;
    // }
    
    // /**
    // * Remove idPolicy
    // *
    // * @param \All\Entity\Policy $idPolicy
    // */
    // public function removeIdPolicy(\All\Entity\Policy $idPolicy)
    // {
    // $this->idPolicy->removeElement($idPolicy);
    // }
    
    public function getPolicy(){
        return $this->policy;
    }
    public function setPolicy($policy){
        $this->policy = $policy;
        return $this;
    }
    
    public function getCoverNote(){
        return $this->coverNote;
    }
    
    public function setCoverNote($note){
        $this->coverNote = $note;
        return $this;
    }
    
    
}
