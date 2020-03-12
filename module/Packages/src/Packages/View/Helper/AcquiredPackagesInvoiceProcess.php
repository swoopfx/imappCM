<?php
namespace Packages\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;


/**
 *
 * @author otaba
 *        
 */
class AcquiredPackagesInvoiceProcess extends AbstractHelper implements ServiceLocatorAwareInterface
{
    
    private $serviceLocator;

    /**
     */
    public function __construct()
    {}

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::getServiceLocator()
     *
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::setServiceLocator()
     *
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    public function __invoke($customerPackageEntity)
    {
        
        
        $status = "";
        
        if (count($customerPackageEntity->getObject()) == 0 ) {
            $status = "disabled = 'disabled'";
            $link = $this->linkFrame($status);
            $link = "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                
                   No invoice generated yet
                </div><br>";
            return $link;
        }else{
            
            $link ="";
            $status = " ";
            $link = $this->linkFrame($status);
            if($customerPackageEntity->getInvoice() != NULL){
                $link = "<a href='' style='width:100%;' data-toggle='modal' data-target='.bs-invoice-modal-lg' class='btn btn-default btn-xs' ><i class='fa fa-credit-card'></i> Invoice Generated </a>";
                
            }
            return $link;
        }
    }
    
    private function linkFrame($status){
        $url = $this->getServiceLocator()
        ->getServiceLocator()
        ->get("ViewHelperManager")
        ->get("url");
        
        $link = "<a href='" . $url("acquired-packages/default", array(
            "action" => "invoice-generate",
            
        )) . "' class='btn btn-success btn-lg' " . $status . " style='width: 100%;'> <i class='fa fa-send'></i> Generate Invoice</a>";
        
        return $link;
    }
}

