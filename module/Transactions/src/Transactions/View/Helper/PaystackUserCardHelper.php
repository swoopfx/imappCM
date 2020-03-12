<?php
namespace Transactions\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * This class displays all registered card for this user
 *
 * @author otaba
 *        
 */
class PaystackUserCardHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $serviceLocator;

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function __invoke($userEntity)
    {
        $generalService = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("GeneralServicer\Service\GeneralService");
        $em = $generalService->getEntityManager();
        $availableCard = $em->getRepository("Transactions\Entity\PaystackUserAutorizationCode")->findBy(array(
            "user" => $userEntity,
            "isHidden"=>false
        ));
        if ($availableCard != NULL) {
            return "<div class='list-group margin-none'>" . $this->frameee($availableCard) . "</div>";
        }
    }

    private function frameee($deta)
    {
        $url = $this->getServiceLocator()
        ->getServiceLocator()
        ->get("ViewHelperManager")
        ->get("url");
        
        $partial = $this->getServiceLocator()
        ->getServiceLocator()
        ->get("ViewHelperManager")
        ->get("partial");
        
        $form = $this->getServiceLocator()->getServiceLocator()
        ->get("FormElementManager")
        ->get("Transactions\Form\AuthPaymentForm");
        
        
        
        
        $faa = "";
      $count = count($deta);
       // foreach ($deta as $detail) {
        $detail = $deta[$count-1];
            $form->setAttributes(array(
                "action"=>$url("board/default", array("action"=>"payment")),
            ));
            $data = array(
                "data"=>$detail->getAuthorizatioCode()
            );
            $form->get("auth")->setValue($detail->getAuthorizatioCode());
            $faa .= "
                  <div class='list-group-item media v-middle'>
                    <div class='media-left'>
                      <div class='icon-block half img-circle bg-primary'>
                        <i class='fa fa-credit-card'></i>
                      </div>
                    </div>
                    <div class='media-body'>
                      <h4 class='text-title media-heading'>
                        <a  class=' ajax_element btn' id='sendingData' data-href='authpaymodal'
									data-json='".json_encode($data)."'>**** **** **** ".$detail->getLastFour()."</a>
                      </h4>
                      <div class='text-caption'>Card Expires: ".$detail->getExpMonth()."/".$detail->getExpYear()."</div>
                    </div>
<div class='media-right'>
                      <a class=' btn btn-primary ajax_element' id='sendingData' data-href='authpaymodal'
									data-json='".json_encode($data)."'><i class='fa fa-location-arrow fa-fw'></i> Pay</a>
                    </div>
                    
                  </div>
                  
               ";
        //}
        return $faa;
    }
}

