<?php
namespace User\Service;

use Zend\Crypt\Password\Bcrypt;
use CsnUser\Entity\User;

class UserService
{

    protected $entityManager;

    /**
     *
     * @param UserIndentiity $identity            
     * @return string
     */
    public function getUsesFullName($identity)
    {
        $fullName = '';
        
        return $fullName;
    }
    
    /**
     * Static function for checking hashed password (as required by Doctrine)
     *
     * @param CsnUser\Entity\User $user
     *            The identity object
     * @param string $passwordGiven
     *            Password provided to be verified
     * @return boolean true if the password was correct, else, returns false
     */

    public static function verifyHashedPassword(User $user, $passwordGiven)
    {
        $bcrypt = new Bcrypt(array(
            'cost' => 10
        ));
        return $bcrypt->verify($passwordGiven, $user->getPassword());
    }

    /**
     * Encrypt Password
     *
     * Creates a Bcrypt password hash
     *
     * @return String
     */
    public static function encryptPassword($password)
    {
        $bcrypt = new Bcrypt(array(
            'cost' => 10
        ));
        return $bcrypt->create($password);
    }
}