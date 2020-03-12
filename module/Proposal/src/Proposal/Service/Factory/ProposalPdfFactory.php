<?php
namespace Proposal\src\Proposal\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Proposal\src\Proposal\Service\ProposalPdf;

class ProposalPdfFactory implements FactoryInterface
{

    public function __construct()
    {

        // TODO - Insert your code here
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $pdf = new ProposalPdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $generalService = $serviceLocator->get('GeneralServicer\Service\GeneralService');

        $pdf->setEntityManager($generalService->getEntityManager())
            ->setUrlViewHelper($generalService->getUrlViewHelper())
            ->setGeneralService($generalService);
        return $pdf;
    }
}

