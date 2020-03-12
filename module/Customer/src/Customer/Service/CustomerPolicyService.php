<?php
namespace Customer\Service;

use Policy\Service\CoverNoteService;

/**
 * This provides Policy related services to Customer
 * 
 * @author otaba
 *        
 */
class CustomerPolicyService
{
    
    private $entityManager;

    private $policyId;
    
    /**
     */
    public function __construct()
    {
        
        // TODO - Insert your code here
    }
    
    
    /**
     * This function creates a renewable premium fprom a previously generated invoice 
     * If the policy has its own invoice, 
     * extract inoice from there 
     * Else if  it does not get the invoice from the cover note 
     * 
     * @return string
     */
    public function renewablePrmium(){
        $em  = $this->entityManager;
        $policyEntity = $em->find("Policy\Entity\Policy", $this->policyId);
        $premium = "";
        if($policyEntity->getInvoice() != NULL){
            $invoiceEntity = $policyEntity->getInvoice();
            $premium = $invoiceEntity->getAmount();
        }else{
            $coverCategory = $policyEntity->getCoverNote()->getCoverCategory()->getId();
            switch ($coverCategory){
                case CoverNoteService::COVERNOTE_CATEGORY_OFFER:
                   $invoiceEntity = $policyEntity->getCoverNote()->getOffer()->getInvoice();
                   return $invoiceEntity->getAmount();
                    break;
                    
                case CoverNoteService::COVERNOTE_CATEGORY_PROPOSAL:
                    $invoiceEntity = $policyEntity->getCoverNote()->getProposal()->getInvoice();
                    return $invoiceEntity->getAmount();
                    break;
                    
                case CoverNoteService::COVERNOTE_CATEGORY_FLOAT_POLICY:
                    
                    break;
            }
        }
        
        return $premium;
    }
    
    
    public function setPolicyEntity($pol){
        $this->policyEntity = $pol;
        return $this;
    }
    
    public function setEntityManager($em){
        $this->entityManager = $em;
        return $this;
    }
    
    
}

