<?php
namespace Customer\View\Helper\Proposal;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Session\Container;


/**
 *
 * @author otaba
 *        
 */
class CustomerProposalPremiumViewHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{
    
    private $serviceLocator;

    

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

   
    
    public function __invoke($proposalEntity){
        $premiumSession = new Container("proposal_premium");
        $url = $this->getServiceLocator()
        ->getServiceLocator()
        ->get("ViewHelperManager")
        ->get("url");
        $currencyFormat = $this->getServiceLocator()
        ->getServiceLocator()
        ->get("ViewHelperManager")
        ->get("myCurrencyFormat");
        
        $jsonType = '{"type":"standard"}';
        $selectObjectUrl = $url("cus_proposal/default", array("action"=>"selectproperty"));
        $registerNewUrl = $url("cus_proposal/default", array("action"=>"registernewproperty"));
        $premiumService = $this->getServiceLocator()
        ->getServiceLocator()
        ->get("GeneralServicer\Service\PremiumService");
        
        if ($proposalEntity->getValue() == NULL || $proposalEntity->getValueType() == NULL) {
            return "<a href='#' style='width:100%'  class='btn btn-sm btn-danger'>Proposal Incomplete</a><br>";
        } elseif (count($proposalEntity->getObject()) == 0) {
            return "<p style='text-align: center;'>
						<a id='btn2'
							class='ajax_element btn btn-xs btn-warning paper-shadow relative'
							data-json='$jsonType'
							data-href='$selectObjectUrl'
							data-animated style='width: 100%'>Include
							a Property</a>
							
							 <br> OR <br> <a id='btn3'
							class='ajax_element btn bt-xs btn-primary paper-shadow relative '
							data-json='$jsonType'
							data-href='$registerNewUrl'
							data-z='0.5' data-animated style='width: 100%'>Register
							New Property</a>
					</p>";
        } elseif ($proposalEntity->getValue() != NULL && $proposalEntity->getValueType() != NULL && count($proposalEntity->getObject()) > 0) {
            $premiumService->setValueType($proposalEntity->getValueType()
                ->getId())
                ->setObjectsArray($proposalEntity->getObject())
                ->setPremiumRate($proposalEntity->getValue());
                $objectArray = $proposalEntity->getObject();
                if($proposalEntity->getIsManualPremium() == TRUE){
                    $manualPremium = $proposalEntity->getManualPremium();
                    $premiumSession->isAuto = FALSE;
                    $premiumSession->premiumCurrency = $manualPremium->getCurrency()->getCode();
                    $premiumSession->premium = $manualPremium->getPremium();
                    return $this->premiumCondition($proposalEntity, $premiumSession, $premiumSession->premiumCurrency);
                }else{
                $premium = $premiumService->premiumCalculator();
                $currency = $objectArray[count($objectArray) - 1]->getCurrency()->getCode();
                $premiumSession->premiumCurrency = $objectArray[count($objectArray) - 1]->getCurrency()->getId();
                $premiumSession->premium = $premium;
                return $this->premiumCondition($proposalEntity, $premiumSession, $currency);
                }
        }
    }
    
    private function premiumCondition($offerEntity, $premiumSession, $currency){
        $url = $this->getServiceLocator()
        ->getServiceLocator()
        ->get("ViewHelperManager")
        ->get("url");
        $currencyFormat = $this->getServiceLocator()
        ->getServiceLocator()
        ->get("ViewHelperManager")
        ->get("myCurrencyFormat");
        if($offerEntity->getIsManualPremium() == TRUE){
            $premiumSession->premium = $offerEntity->getManualPremium()->getPremium();
            $premiumSession->premiumCurrency = $offerEntity->getManualPremium()->getCurrency()->getId();
            return "<h2>".$currencyFormat($offerEntity->getManualPremium()->getPremium(), $offerEntity->getManualPremium()->getCurrency()->getCode())."</h2>";
        }else{
            
            return "<h2>" . $currencyFormat($premiumSession->premium, $currency) . "</h2>";
        }
    }
}

