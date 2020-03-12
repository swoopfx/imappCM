<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Status
 *
 * @ORM\Table(name="status")
 * @ORM\Entity
 */
class Status
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
     * @var string @ORM\Column(name="status_word", type="string", length=500, nullable=true)
     */
    private $statusWord;

    /**
     * Get idstatus
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set statusWord
     *
     * @param string $statusWord            
     * @return Status
     */
    public function setStatusWord($statusWord)
    {
        $this->statusWord = $statusWord;
        
        return $this;
    }

    /**
     * Get statusWord
     *
     * @return string
     */
    public function getStatusWord()
    {
        return $this->statusWord;
    }
}
