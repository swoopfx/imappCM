<?php
namespace Customer\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Customer\Service\CustomerService;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

/**
 *
 * @author swoopfx
 *        
 */
class CustomerCategoryAvatarHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{

    private $entityManager;

    private $serviceLocator;

    public function __invoke($category)
    {
        $frame = "";
        $em = $this->getServiceLocator()->getServicelocator()->get('doctrine.entitymanager.orm_default');
        
        switch ($category) {
            case CustomerService::CUSTOMER_CATEGORY_ORG: // ORGANISATIO
                
                $avatar = $em->find("Customer\Entity\CustomerCategory", $category);
                $frame = $avatar->getAvatar();
                break;
            case CustomerService::CUSTOMER_CATEGORY_IND:
                $avatar = $em->find("Customer\Entity\CustomerCategory", $category);
                $frame = $avatar->getAvatar();
                break;
        }
        return $frame;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::setServiceLocator()
     */
    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::getServiceLocator()
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

/**
 *
 * {@inheritdoc}
 *
 * @see \Zend\ServiceManager\ServiceManagerAwareInterface::setServiceManager()
 */
}

