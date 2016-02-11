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
    
    
    protected $errorDictionary = [
        100 => 'RestaurantId not found in a database',
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
        111 => 'Problem in image uploading',
        112 => 'Update your email and username before uploading profile photo OR check your userId and emailId',
        113 => 'Error to save user profile image. please try again.',
        114 => 'Invalid user details',
        115 => 'Mail was not send. try again',
        116 => 'Please choose valid input',
        117 => 'Invalid data',
        118 => 'Invalid to email address',
        119 => 'OTP verification failed',
        120 => 'Answer Not Saved'
       ];
    
    
}
