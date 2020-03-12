<?php
namespace Customer\View\Helper\Packages;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 *
 * @author otaba
 *        
 */
class CustomerPackageObjectList extends AbstractHelper implements ServiceLocatorAwareInterface
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

    public function __invoke($objectArray)
    {
        $url = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("url");
        
        $currencyFormat = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("myCurrencyFormat");
        $frame = "";
        $objectTotal = 0;
        $link = "<p style='text-align: center;'><a href='#modal-include-object' data-toggle='modal'
						class='btn  btn-flat btn-primary'
						class='btn  paper-shadow relative' data-z='0.5'
						data-hover-z='1' data-animated style='width: 100%' > Include a Property</a> <br> OR <br>
 <a href='#modal-register-object' data-toggle='modal'
						class='btn btn-white btn-flat btn-primary'
						class='btn btn-white paper-shadow relative' data-z='0.5'
						data-hover-z='1' data-animated style='width: 100%' > Register New Property </a></p>";
        
        if (count($objectArray) == 0) {
            return $link;
        } else {
            for ($i = 0; $i < count($objectArray); $i ++) {
                $objectTotal = $objectTotal + $objectArray[$i]->getValue();
                $frame .= "<li class='list-group-item'>
							<div class='list-group-item media'
								data-target='website-take-course.html'>
								<div class='media-left'>
									<div class='text-crt'></div>
								</div>
								<div class='media-body'>
									<i class='fa fa-fw fa-circle text-green-300'></i>  " . $objectArray[$i]->getObjectName() . " (" . $currencyFormat($objectArray[$i]->getValue(), $objectArray[$i]->getCurrency()->getCode()) . ") <br>
								</div>
								<div class='media-right'>
									<div class='width-100 text-right text-caption'><a style='width: 100%;' href='" . $url("cus_pack/default", array(
                    "action" => "remove-object",
                    "id" => $objectArray[$i]->getId()
                )) . "'  class='btn btn-xs btn-danger confirmation'>Remove</a></div>
								</div>
							</div>
									    
						</li>";
            }
            return $frame . "<li class='list-group-item paper-shadow'>
							<div class='media v-middle'>
								<div class='media-left'>
									<div class='icon-block s30 bg-green-300 text-white img-circle'>
										<i class='fa fa-database'></i>
									</div>
								</div>
								<div class='media-body text-body-2'><strong>Total Property SUM = " . $currencyFormat($objectTotal, $objectArray[count($objectArray) - 1]->getCurrency()->getCode()) . "</strong>.</div>
							</div>
						</li>" . $link;
            ;
        }
    }
}

