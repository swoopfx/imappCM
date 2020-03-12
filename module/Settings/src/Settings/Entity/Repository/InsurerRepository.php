<?php
namespace Settings\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 *
 * @author otaba
 *        
 */
class InsurerRepository extends EntityRepository
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
    
    
    public function findActiveInsurer(){
        $dql = "SELECT i FROM Settings\Entity\Insurer i  WHERE i.isActive = true ORDER BY i.id DESC ";
        $query = $this->getEntityManager()
        ->createQuery($dql)
        ->getResult();
        return $query;
    }
}

