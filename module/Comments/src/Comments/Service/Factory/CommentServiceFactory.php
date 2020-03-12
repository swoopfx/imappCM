<?php
namespace Comments\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Comments\Service\CommentService;


/**
 *
 * @author swoopfx
 *        
 */
class CommentServiceFactory implements FactoryInterface
{

   

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     *
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $xserv = new CommentService();
        $generalService = $serviceLocator->get('GeneralServicer\Service\GeneralService');
        $em = $generalService->getEntityManager();
        $xserv->setGeneralService($generalService)->setEntityManager($em);
        return $xserv;
        
    }
}

