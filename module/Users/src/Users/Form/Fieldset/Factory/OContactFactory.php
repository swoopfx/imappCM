<?php
namespace Users\Form\Fieldset\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Users\Form\Fieldset\OContactFieldset;

/**
 *
 * @author swoopfx
 *        
 */
class OContactFactory implements FactoryInterface
{

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $ocontact = new OContactFieldset();
        $em = $serviceLocator->get('doctrine'); // TODO - Finanlize the configuration of the doctrine service
        $ocontact->setEntityManager($em);
        return $ocontact; // TODO- Remeber to instantiate this class in the module.config folder
    }
}

?>