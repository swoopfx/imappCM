<?php
namespace Report\Service;

/**
 *
 * @author swoopfx
 *        
 */
class ReportService
{
   private $generalService;
   
    public function __construct()
    {
        
        
    }
    
    private function customerReport(){
        $data = NULL;
        return $data;
    }
    
    private function premiumReport(){
        $data = NULL;
        return $data;
    }
    
    private  function claimsReport(){
        $data = NULL;
        return $data;
    }
    
    private function transactionReport(){
        $data = NULL;
        return $data;
    }
    
    
    public function setGeneralService($serve){
        $this->generalService = $serve;
        return $this;
    }
}

