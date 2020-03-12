<?php
namespace Transactions\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;



/**
 *
 * @author swoopfx
 *        
 */
class ImappInvoiceOfficeViewHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $serviceLocator;

    public function __invoke(){
        $config = $this->config();
       
        return $this->frame($config);
    }
    
    private function config(){
        $config = $this->getServiceLocator()->getServiceLocator()->get('Config');
        return $config;
    }
    private function frame($config){
        $frame = '';
        $frame .= "<div class='col-sm-4 invoice-col'>
                          From:
                          <address>
                                          <strong>".$config['imapp_office']['company_name']."</strong>
                                          <br>".$config['imapp_office']['Address']."
                                          <br>".$config['imapp_office']['State'].", ".$config['imapp_office']['Country']."
                                          <br><strong>Billing:</strong> ".$config['imapp_office']['Tel']['billing']."
                                              <br><strong>Admin : </strong>".$config['imapp_office']['Tel']['Admin_Office']."
                                                  <br><strong>Tech:</strong></strong> ".$config['imapp_office']['Tel']['tech_support']."
                                          <br><strong>Email: </strong>".$config['imapp_office']['email']."
                                      </address>
                        </div>";
        
        return $frame;
    }

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
    }

  
}

