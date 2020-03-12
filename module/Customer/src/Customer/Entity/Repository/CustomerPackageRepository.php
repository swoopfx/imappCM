<?php
namespace  Customer\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class CustomerPackageRepository extends EntityRepository{
	
	public function findCustomerSpecificPackage($customerPackageId, $brokerId){
		$dql = "SELECT cp, p , vt FROM Customer\Entity\CustomerPackage cp  JOIN cp.packages p JOIN p.valueType vt JOIN cp.customer c JOIn c.customerBroker cb WHERE cb.broker = :broker AND cp.id = :id ORDER BY cp.id DESC";
		$query = $this->getEntityManager()->createQuery($dql)->setParameters(array(
				'broker'=>$brokerId,
				"id"=>$customerPackageId
		))->getResult();
		return $query;
	}
	
	
}