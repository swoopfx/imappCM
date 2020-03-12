<?php
namespace Offer\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Session\Container;
use Offer\Service\OfferService;

/**
 *
 * @author otaba
 *        
 */
class OfferManualPaymentHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $serviceLocator;

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

    public function __invoke($offerEntity)
    {
        $premiumSession = new Container("offer_premium");
        $offerPremium = $premiumSession->premium;
        $url = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("url");
        
        $transactionService = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("Transactions\Service\TransactionService");
        
        $frame = "";
        //if ($offerPremium == NULL) {}
        if ($offerPremium == NULL) {
            $info = "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                    </button>
                    <strong>Please complete all required information on this offer page</strong> 
                  </div>";
            return $this->showDetails($info);
        } elseif ($offerPremium != NULL && $offerEntity->getInvoice() == NULL) {
            $info = "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                    </button>
                    <strong>The invoice must be generated </strong>
                  </div>";
            return $this->showDetails($info);
        } elseif ($offerPremium != NULL && $offerEntity->getInvoice() != NULL) {
            if ($offerEntity->getInvoice()->getManualProcess() == NULL && $offerEntity->getOfferStatuses()->getId() != OfferService::OFFER_STATUS_PAID) {
                
                $info = "<div align='center'><a data-toggle='tooltip' data-placement='top' title='Click this to remind the customer of his outstanding payment' class='btn btn-xs btn-primary' style='width: 100%;' href='".$url()."'>Remind Customer for Payment</a><br><strong>OR</strong><br><a data-toggle='tooltip' data-placement='top' title='Click this to enter payment on behalf of the customer' class='btn btn-xs btn-success' style='width: 100%;' href='#'>Submit Payment</a></div>";
                return $this->showDetails($info);
            } elseif ($offerEntity->getInvoice()->getManualProcess() != NULL && $offerEntity->getOfferStatuses()->getId() != OfferService::OFFER_STATUS_PAID) {
                $mans = $transactionService->getCustomerManualPayment($offerEntity->getInvoice()
                    ->getManualProcess());
                $info = "";
                foreach ($mans as $man) {
                    
                    $info .= "<a href=''>Accept Payment</a>";
                }
                $info = "<div align='center'><a class='btn btn-xs btn-primary' style='width: 100%;' href='#'>Remind Customer for Payment</a><br><strong>OR</strong><br><a class='btn btn-xs btn-success' style='width: 100%;' href='#'>Fill Payment Form</a></div>";
                return $this->showDetails($info);
            }
        }
    }

    private function showDetails($info, $manualDepositEntity = NULL)
    {
        $frame = "<div class='col-md-12 col-xs-12'>
			<div class='x_panel'>
				<div class='x_title'>
            
					<strong>Manual Payment</strong>
            
					<div class='clearfix'></div>
					<div class='x_content'>
						<br>
            " . $info . "
					</div>
            
				</div>
			</div>
            
		</div>";
        return $frame;
    }
}

