<?php
namespace Customer\View\Helper\Proposal;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 *
 * @author otaba
 *        
 */
class CustomerProposalListObject extends AbstractHelper implements ServiceLocatorAwareInterface
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

    /**
     * This get list all associated Objects
     */
    public function __invoke($proposalEntity)
    {
        $lnk ="";
        $url = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("url");
        
        $currencyFormat = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("myCurrencyFormat");
        
            $disabled = ($proposalEntity->getInvoice() != NULL ? "disabled" : "");
        
        if (count($proposalEntity->getObject()) == 0) {
            $link = "<span>There is no property available </span>";
        } else {
            $objectArray = $proposalEntity->getObject();
            foreach ($objectArray as $object) {
                $json = json_encode(array(
                    "data"=>$object->getId()
                ));
                $lnk .= "<div class='list-group-item media'
						data-target='website-take-course.html'>
						
						<div class='media-body'>
							<i class='fa fa-fw fa-circle text-grey-200'></i> " . $object->getObjectName() . "
						</div>
						<div class='media-right'>
							<div class='width-100 text-right text-caption'>" . $currencyFormat($object->getValue(), $object->getCurrency()->getCode()) . " <a id='sending_data_button' style='width: 100%;'  data-href='" . $url("cus_proposal/default", array(
                    "action" => "removeobjectdialog"
                   
                )) . "' data-json='{$json}' {$disabled} class='ajax_element btn btn-xs btn-danger'>Remove</a></div>
						</div>
					</div>";
            }
            
            return $lnk;
        }
    }
}

