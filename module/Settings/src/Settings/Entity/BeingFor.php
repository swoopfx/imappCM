<?php
namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This calss defines a preset value that identifies transaction on the application
 *
 * @author swoopfx
 *        
 */

/**
 * BeingFor
 *
 * @ORM\Table(name="being_for")
 * @ORM\Entity
 */
class BeingFor
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
     * @var string @ORM\Column(name="word", type="string", nullable=false)
     */
    private $word;

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
     * Get id
     *
     * @return integer
     */
    public function getWord()
    {
        return $this->word;
    }

    /**
     * Set word
     *
     * @param string $word            
     *
     * @return Word
     */
    public function setWord($word)
    {
        $this->word = $word;
        
        return $this;
    }
}

?>