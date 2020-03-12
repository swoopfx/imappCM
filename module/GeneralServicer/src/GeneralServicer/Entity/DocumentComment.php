<?php
namespace GeneralServicer\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentComment
 *
 * @ORM\Table(name="document_comment", indexes={@ORM\Index(name="FK_document_comment_idx", columns={"doc_id"})})
 * @ORM\Entity
 */
class DocumentComment
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
     * @var string @ORM\Column(name="date_created", type="string", length=100, nullable=true)
     */
    private $dateCreated;

    /**
     *
     * @var \GeneralServicer\Entity\Document @ORM\ManyToOne(targetEntity="GeneralServicer\Entity\Document")
     *      @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="doc_id", referencedColumnName="id")
     *      })
     */
    private $doc;

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
     * @return DocumentComment
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
     * Set dateCreated
     *
     * @param string $dateCreated            
     *
     * @return DocumentComment
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

    /**
     * Set doc
     *
     * @param \All\Entity\Document $doc            
     *
     * @return DocumentComment
     */
    public function setDoc(\All\Entity\Document $doc = null)
    {
        $this->doc = $doc;
        
        return $this;
    }

    /**
     * Get doc
     *
     * @return \All\Entity\Document
     */
    public function getDoc()
    {
        return $this->doc;
    }
}
