<?php
namespace Proposal\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Session\Container;
use Transactions\Service\InvoiceService;

/**
 *
 * @author otaba
 *        
 */
class ProposalProcessPremiumViewHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $serviceLocator;

    public function __invoke($proposalEntity)
    {
        $premiumSession = new Container("proposal_premium");
        $url = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("url");
        $currencyFormat = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("myCurrencyFormat");

        $son = array(
            "type" => "standard"
        );
        $premiumService = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("GeneralServicer\Service\PremiumService");

        $proposalService = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("Proposal\Service\ProposalService");

        $json = json_encode(array(
            "type" => "standard"
        ));
        if ($proposalEntity->getValue() == NULL || $proposalEntity->getValueType() == NULL) {
            return "<a id='btn2' data-href='" . $url("proposal/default", array(
                "action" => "complete"
            )) . "' style='width:100%' data-ajax-loader='procesPremium' data-json='" . json_encode($son) . "' class=' ajax_element btn btn-sm btn-danger'>Complete Proposal Information</a>";
        } elseif (count($proposalEntity->getObject()) == 0 && $proposalEntity->getIsManualPremium() == FALSE) {
            return "<p style='text-align: center;'><button id='btn3' class='ajax_element btn btn-danger' style='width: 100%' data-ajax-loader='procesPremium'  data-json='" . $json . "' data-href='" . $url("proposal/default", array(
                "action" => "manual-premium"
            )) . "' >Enter Manual Premium</button></p>";
        } elseif ($proposalEntity->getValue() != NULL && $proposalEntity->getValueType() != NULL) {
            $proposalService->proposalPremiumGenerator($proposalEntity);
            return $this->premiumCondition($proposalEntity, $premiumSession, $premiumSession->premiumCurrency);
        }
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    private function premiumCondition($proposalEntity, $premiumSession, $currency = "NGN")
    {
        $url = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("url");
        $currencyFormat = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("myCurrencyFormat");

        $json = json_encode(array(
            "type" => "standard"
        ));

        $disable = ($proposalEntity->getInvoice() != NULL ? ($proposalEntity->getInvoice()
            ->getStatus()
            ->getId() == InvoiceService::INVOICE_PAID_STATUS ? "disabled='disabled'" : "") : "");
        $son = array(
            "type" => "standard"
        );
        if ($proposalEntity->getIsManualPremium() == TRUE) {
            $premiumSession->premium = $proposalEntity->getManualPremium()->getPremium();
            $premiumSession->premiumCurrency = $proposalEntity->getManualPremium()
                ->getCurrency()
                ->getId();
            return "<h2>" . $currencyFormat($proposalEntity->getManualPremium()->getPremium(), $proposalEntity->getManualPremium()
                ->getCurrency()
                ->getCode()) . "</h2><a id='btn2' data-ajax-loader='procesPremium' " . $disable . "  href='" . $url("proposal/default", array(
                "action" => "remove-manual-premium"
            )) . "' data-json='" . json_encode($son) . "' class=' ajax_element btn btn-danger btn-xs'>Remove Manual Premium</a>  <i data-toggle='tooltip' data-placement='top' title='Remove manually generated premium ' class='fa fa-info-circle'></i>";
        } else {

            return "<h2>" . $currencyFormat($premiumSession->premium, $currency) . "</h2><br><button " . $disable . " id='btn3' data-ajax-loader='procesPremium' class=' btn-xs ajax_element btn btn-success'   data-json='" . $json . "' data-href='" . $url("proposal/default", array(
                "action" => "manual-premium"
            )) . "' >Enter Manual Premium</button> <i data-toggle='tooltip' data-placement='top' title='Manually generate a premium if the auto generated premium does not seem correct' class='fa fa-info-circle'></i>";
        }
    }
}

