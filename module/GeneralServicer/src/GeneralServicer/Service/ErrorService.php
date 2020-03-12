<?php
namespace GeneralServicer\Service;

class ErrorService
{

    // TODO - Insert your code here
    public function __construct()
    {

        // TODO - Insert your code here
    }
    
    public static function errorFromForm($arrayErr){
        
            
       
        foreach ( $arrayErr as $message => $err) {
            if (is_array($err)) {
                foreach ($err as $mess => $fr) {
                    if (is_array($fr)) {
                        foreach ($fr as $ss) {
                            $messages = str_replace([
                                "{",
                                "}"
                            ], " ", json_encode($ss));
                            return $messages = str_replace(",", "<br>", $messages);
                        }
                    } else {
                        $messages = str_replace([
                            "{",
                            "}"
                        ], " ", json_encode($ss));
                        return $messages = str_replace(",", "<br>", $messages);
                    }
                }
            }
        }
        
    }
}

