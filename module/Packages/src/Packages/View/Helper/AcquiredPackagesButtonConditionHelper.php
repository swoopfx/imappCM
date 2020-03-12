<?php
namespace Packages\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Packages\Service\AcquirePackagesService;

/**
 *
 * @author otaba
 *        
 */
class AcquiredPackagesButtonConditionHelper extends AbstractHelper implements ServiceLocatorAwareInterface
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

    public function __invoke($customerPackageEntity)
    {
        $url = $this->getServiceLocator()
            ->getServiceLocator()
            ->get("ViewHelperManager")
            ->get("url");
        $packageStatusId = $customerPackageEntity->getAcquiredPackageStatus()->getId();
        
        switch ($packageStatusId) {
            case AcquirePackagesService::ACQUIRED_PACKAGE_PAID:
                return "<a href='" . $url("acquired-packages/default", array(
                    "action" => "pre-process",
                    "id" => $customerPackageEntity->getId()
                )) . "' class='btn btn-success btn-sm' style='width: 100%;'>Begin Processing</a>";
                break;
            
            case AcquirePackagesService::ACQUIRED_PACKAGE_UNPAID:
                return "<a href='" . $url("acquired-packages/default", array(
                    "action" => "send-reminder",
                    "id" => $customerPackageEntity->getId()
                )) . "' class='btn btn-danger btn-sm' style='width: 100%;'>Send Reminder</a>";
                break;
            
            case AcquirePackagesService::ACQUIRED_PACKAGE_PAID_PROCESSING:
                $link = "<a href='" . $url("acquired-packages/default", array(
                    "action" => "continue-process",
                    "id" => $customerPackageEntity->getId()
                )) . "' class='btn btn-success btn-sm' style='width: 100%;'>Generate CoverNote</a>";
                
                $asignee = "<div class='btn-group'>
                    <button style='width: 100%;' data-toggle='dropdown' class='btn btn-default dropdown-toggle btn-sm' type='button' aria-expanded='false'>Processing Brokers <span class='caret'></span>
                    </button>
                    <ul role='menu' class='dropdown-menu'>
                      <li><a href='#'>Action</a>
                      </li>
                      <li><a href='#'>Another action</a>
                      </li>
                      <li><a href='#'>Something else here</a>
                      </li>
                      <li class='divider'></li>
                      <li><a href='#'>Separated link</a>
                      </li>
                    </ul>
                    </div>";
                if ($customerPackageEntity->getCoverNote() == NULL) {
                    return $link . $asignee;
                } elseif ($customerPackageEntity->getCoverNote() != NULL) {
                    return $link.$asignee;
                }
                break;
            
            case AcquirePackagesService::ACQUIRED_PACKAGE_SETTLED:
                return " <a href='" . $url("cover-note/default", array(
                    "action" => "pre-view",
                    "id" => $customerPackageEntity->getCoverNote()->getId()
                )) . "' class='btn btn-success btn-sm' style='width: 100%;'>View Policy Generated</a>";
                break;
            
            case AcquirePackagesService::ACQUIRED_PACKAGE_CANCELLED:
                return "<a href='" . $url("acquired-packages", array(
                    "action" => "pre-process",
                    "id" => $customerPackageEntity->getId()
                )) . "' class='btn btn-warning btn-sm' style='width: 100%;'>Restore Package</a> ";
                break;
            
            default:
                return "<a href='" . $url("acquired-packages/default", array(
                    "action" => "pre-process",
                    "id" => $customerPackageEntity->getId()
                )) . "' class='btn btn-success btn-sm' style='width: 100%;'>View Package</a>";
                break;
        }
    }
}

