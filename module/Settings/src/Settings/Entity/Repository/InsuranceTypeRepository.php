<?php
namespace Settings\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 *
 * @author otaba
 *        
 */
class InsuranceTypeRepository extends EntityRepository
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
    
    
   public function findNonCompositeInsuranceType(){
       $dql = "SELECT i FROM Settings\Entity\InsuranceType i  WHERE i.id != 1 ORDER BY i.id DESC ";
       $query = $this->getEntityManager()
       ->createQuery($dql)
       ->getResult();
       return $query;
   }
}

