<?php
namespace Policy\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Policy\Service\CoverNoteService;

/**
 *
 * @author otaba
 *        
 */
class CoverNoteNameHelper extends AbstractHelper
{

    public function __invoke($coverNoteEntity)
    {
        $coverNoteCategory = $coverNoteEntity->getCoverCategory()->getId();
        if ($coverNoteCategory == CoverNoteService::COVERNOTE_CATEGORY_OFFER) {
            return $coverNoteEntity->getOffer()->getOfferName();
        } elseif ($coverNoteCategory == CoverNoteService::COVERNOTE_CATEGORY_PACKAGES) {
            return $coverNoteEntity->getPackage()
                ->getPackage()
                ->getPackageName();
        } elseif ($coverNoteCategory == CoverNoteService::COVERNOTE_CATEGORY_PROPOSAL) {
            return $coverNoteEntity->getProposal()->getProposalTitle();
        }else{
           return  $coverNoteEntity->getPolicyFloat()->getName();
        }
    }
}

