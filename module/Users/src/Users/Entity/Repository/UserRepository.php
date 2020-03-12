<?php
/**
 * CsnUser - Coolcsn Zend Framework 2 User Module
 * 
 * @link https://github.com/coolcsn/CsnUser for the canonical source repository
 * @copyright Copyright (c) 2005-2013 LightSoft 2005 Ltd. Bulgaria
 * @license https://github.com/coolcsn/CsnUser/blob/master/LICENSE BSDLicense
 * @author Stoyan Cheresharov <stoyan@coolcsn.com>
 * @author Svetoslav Chonkov <svetoslav.chonkov@gmail.com>
 * @author Nikola Vasilev <niko7vasilev@gmail.com>
 * @author Stoyan Revov <st.revov@gmail.com>
 * @author Martin Briglia <martin@mgscreativa.com>
 */
namespace Users\Entity\Repository;

use Doctrine\ORM\EntityRepository;


/**
 * UserRepository
 *
 * Repository class to extend Doctrine ORM functions with your own
 * using DQL language. More here http://mackstar.com/blog/2010/10/04/using-repositories-doctrine-2
 */
class UserRepository extends EntityRepository
{

    public function youtCustomDQLFunction($number = 30)
    {}

    public function getUsersIdentity($usernameOrEmail)
    {
        $query = "SELECT u FROM Users\Entity\User u WHERE u.email = '$usernameOrEmail' OR u.username = '$usernameOrEmail'";
        
        return $query;
    }
}
