<?php
namespace Settings\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 *
 * @author swoopfx
 *        
 */
class ZoneRepository extends EntityRepository
{
    // TODO - Insert your code here
    
    /**
     *
     * @param EntityManager $em
     *            The EntityManager to use.
     *            
     * @param Mapping\ClassMetadata $class
     *            The class descriptor.
     *            
     */
//     public function __construct($em, ClassMetadata $class)
//     {
//         parent::__construct($em, $class);
//         // TODO - Insert your code here
//     }

    public function findSpecificZone($country = 156)
    {
        $dql = "SELECT z FROM Settings\Entity\Zone z WHERE z.country = :country";
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
            'country' => $country
        ))
            ->getResult();
        
        return $query;
    }
}

