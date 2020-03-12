<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Terms
 *
 * @ORM\Table(name="terms")
 * @ORM\Entity
 */
class Terms
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
     * @var string @ORM\Column(name="term_name", type="string", length=100, nullable=true)
     */
    private $termName;

    /**
     *
     * @var string @ORM\Column(name="terms_description", type="text", nullable=true)
     */
    private $termsDescription;

    /**
     *
     * @var string @ORM\Column(name="terms", type="text", nullable=true)
     */
    private $terms;

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
     * Set termName
     *
     * @param string $termName            
     *
     * @return Terms
     */
    public function setTermName($termName)
    {
        $this->termName = $termName;
        
        return $this;
    }

    /**
     * Get termName
     *
     * @return string
     */
    public function getTermName()
    {
        return $this->termName;
    }

    /**
     * Set termsDescription
     *
     * @param string $termsDescription            
     *
     * @return Terms
     */
    public function setTermsDescription($termsDescription)
    {
        $this->termsDescription = $termsDescription;
        
        return $this;
    }

    /**
     * Get termsDescription
     *
     * @return string
     */
    public function getTermsDescription()
    {
        return $this->termsDescription;
    }

    /**
     * Set terms
     *
     * @param string $terms            
     *
     * @return Terms
     */
    public function setTerms($terms)
    {
        $this->terms = $terms;
        
        return $this;
    }

    /**
     * Get terms
     *
     * @return string
     */
    public function getTerms()
    {
        return $this->terms;
    }
}
