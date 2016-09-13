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
    public $data;


    //format {"errorCode":"100", "message":"User is not authenticated"}
    public static function prepareError($errorcode) {
        
        $errorDto = new ErrorDto();
        $errorDto->errorCode = $errorcode;
        $errorDto->message = $errorDto->errorDictionary[$errorcode];
        return json_encode($errorDto);
    }
    
     public static function prepareSuccessMessage($message, $data = 0) {
        
        $errorDto = new ErrorDto();
        $errorDto->errorCode = 0;
        $errorDto->message = $message;
        $errorDto->data = $data;
        return json_encode($errorDto);
    }
    
    public static function prepareMessage($mesgCode) {
         $errorDto = new ErrorDto();
        return $errorDto->errorDictionary[$mesgCode]; 
    }
    
    
    protected $errorDictionary = [
        99 => 'Error catched cleanly',
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
        109 => 'Request data incorrect',
        110 => 'Table not occupied for cuurent request',
        111 => 'Problem in bill payment for current request',
        112 => 'Error occured in customer addition',
        113 => 'Error occured in customer waiting request addition',
        114 => 'Error occured in customer feedback',
        115 => 'Transaction Entries are deleted',
        116 => 'Your device is not registered with us. For registration Please contact on info@vibeosys.com.',
        117 => 'Menu quantity should be greater than zaro(0)',
        118 => 'Oops ! Cant generate bill',
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
        129 => 'Oops ! Orders not placed',
        130 => 'New user has added',
        131 => 'User information updated',
        132 => 'Oops ! User not added',
        133 => 'Oops ! User information not updated',
        134 => 'Menu information updated',
        135 => 'Table information updated',
        136 => 'Oops ! Menu information not updated',
        137 => 'Oops ! Table information not updated',
        138 => 'Oops ! Request with empty customer information',
        139 => 'Oops ! Customer details can not added',
        140 => 'Oops ! Error not added',
        141 => 'Oops ! Not Found',
        142 => 'Oops ! You are late. Cant cancel order.',
        143 => 'Oops ! Order Not Found',
        144 => 'Order has been served. Can`t cancel',
       ];
    
}
