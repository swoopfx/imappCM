<?php
namespace Packages\Service;

/**
 *
 * @author otaba
 *        
 */
class AcquirePackagesService
{

    private $entityManager;
    
    private $generalService;
    
    private $acquiredPackageSession;

    const ACQUIRED_PACKAGE_UNPAID = 1;

    const ACQUIRED_PACKAGE_PAID = 2;

    const ACQUIRED_PACKAGE_PAID_PROCESSING = 3;

    const ACQUIRED_PACKAGE_CANCELLED = 4;

    const ACQUIRED_PACKAGE_SETTLED = 5;
    
    const ACQUIRED_PACKAGE_PROCESSING = 6 ;
 // meaning a policy has been generated
    public function __construct()
    {}

    public function setEntityManager($em)
    {
        $this->entityManager;
        return $this;
    }
    
    public function generarateCustomerPackageUid(){
        $const = "cuspack";
        $code = \uniqid($const);
        return $code ;
    }
    
    public function getAcquiredPackageSession(){
        return $this->acquiredPackageSession;
    }
    
    public function setAcquiredPackageSession($sess){
        $this->acquiredPackageSession = $sess;
        return $this;
    }
    
    public function setGeneralService($xserv){
        $this->generalService = $xserv;
        return $this;
    }
}

