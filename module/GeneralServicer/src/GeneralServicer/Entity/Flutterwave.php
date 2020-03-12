<?php
namespace Transactions\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="flutterwave")
 * 
 * @author Moyinoluwa
 *        
 */
class Flutterwave
{
    /**
     *
     * @var integer @ORM\Column(name="id", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     *      
     */
    private $id;

    private $user;

    private $key;

    private $userCode;

    public function __construct()
    {}

    public function getId()
    {
        return $this->id;
    }

    public function setUser($user)
    {
        $this->user = $user;
        
        return $this;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function getUserCode()
    {
        return $this->userCode;
    }

    public function setUserCode($code)
    {
        $this->userCode = $code;
        
        return $this;
    }
}

