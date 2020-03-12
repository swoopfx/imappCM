<?php
namespace Transactions\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Session\Container;

/**
 *This class provides a viewhelper for available card on the rave system 
 *for a particular user
 * @author otaba
 *        
 */
class RavePayUserCardHelper extends AbstractHelper implements ServiceLocatorAwareInterface
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

    
    public function __invoke($userEntity)
    {
        $generalService = $this->getServiceLocator()
        ->getServiceLocator()
        ->get("GeneralServicer\Service\GeneralService");
        $em = $generalService->getEntityManager();
        $availableCard = $em->getRepository("Transactions\Entity\RaveCardToken")->findBy(array(
            "user" => $userEntity,
            //"isHidden"=>false
        ));
        $avaialableCardSession = new Container("available_card_session");
        $avaialableCardSession->counting = count($availableCard);
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
            "action"=>$url("board/default", array("action"=>"tokenpayment")),
        ));
        $data = array(
            "data"=>$detail->getEmbededToken()
        );
        $form->get("auth")->setValue($detail->getEmbededToken());
        $faa .= "
                  <div class='list-group-item media v-middle'>
                    <div class='media-left'>
                      <div class='icon-block half img-circle bg-primary'>
                        <i class='fa fa-credit-card'></i>
                      </div>
                    </div>
                    <div class='media-body'>
                      <h4 class='text-title media-heading'>
                        <a  class=' ajax_element btn' id='sendingData' data-href='".$url("cus_payment/default", array("action"=>"preauthmodal"))."'
									data-json='".json_encode($data)."'>**** **** **** ".$detail->getLast4Digit()."</a>
                      </h4>
                      <div class='text-caption'>Card Expires: ".$detail->getCardExpiryMonth()."/".$detail->getCardExpiryYear()."</div>
                    </div>
<div class='media-right'>
                      <a class=' btn btn-primary ajax_element' id='sendingData' data-href='".$url("cus_payment/default", array("action"=>"preauthmodal"))."'
									data-json='".json_encode($data)."'><i class='fa fa-location-arrow fa-fw'></i> Pay</a>
                    </div>
									    
                  </div>
									    
               ";
        //}
        return $faa;
    }
    
}

