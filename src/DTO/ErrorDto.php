<?php
namespace App\DTO;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClsErrorDto
 *
 * @author niteen
 */
class ErrorDto {
    
    public $errorCode;
    public $message;
    
    
    
    //format {"errorCode":"100", "message":"User is not authenticated"}
    public static function prepareError($errorcode) {
        
        $errorDto = new ErrorDto();
        $errorDto->errorCode = $errorcode;
        $errorDto->message = $errorDto->errorDictionary[$errorcode];
        return json_encode($errorDto);
    }
    
     public static function prepareSuccessMessage($message) {
        
        $errorDto = new ErrorDto();
        $errorDto->errorCode = 0;
        $errorDto->message = $message;
        return json_encode($errorDto);
    }
    
    public static function prepareMessage($mesgCode) {
         $errorDto = new ErrorDto();
        return $errorDto->errorDictionary[$mesgCode]; 
    }
    
    
    protected $errorDictionary = [
        100 => 'Restaurant not found in a database',
        404 => 'Requested api endpoint not valid',
        101 => 'Please Check UserId and RestaurantId',
        102 => 'UserId not found in database or RestaurantId not valid',
        103 => 'Update not found',
        104 => 'Invalid request',
        105 => 'Error to Place order',
        106 => 'Orders Not FulFilled for requested customer',
        107 => 'Bill generation has been failed',
        108 => 'Operation name didnt match',
        109 => 'Request data not deserialized correctly',
        110 => 'Table not occupied for cuurent request',
        111 => 'Problem in bill payment for current request',
        112 => 'Error occured in customer addition',
        113 => 'Error occured in customer waiting request addition',
        114 => 'Error occured in customer feedback',
        115 => 'Transaction Entries are deleted',
        116 => 'Your not registered with system. Please contact on info@vibeosys.com.',
        117 => 'Menu quantity should be greater than zaro(0)',
        118 => 'Cant generate bill twise',
        119 => 'Error in customer remove',
        120 => 'We cant process takeaway request',
        121 => 'Your username or password is incorrect',
        122 => 'Restaurant data updated successfully',
        123 => 'Oops ! Could not update',
        124 => 'Oops ! bill not generated for this table',
        125 => 'Oops ! Tables not found for this resaurant',
        126 => 'Oops ! Orders not found for this table',
        127 => 'Oops ! Takeway not found for this resaurant',                
        128 => 'Oops ! Orders not found for this takeaway',
       ];
    
    
}
