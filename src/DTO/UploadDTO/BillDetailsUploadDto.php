<?php
namespace App\DTO\UploadDTO;


use App\DTO;
/**
 * Description of BillDetailsUploadDto
 *
 * @author niteen
 */
class BillDetailsUploadDto extends DTO\JsonDeserializer{
    
    public $orderId;
    public $billNo;
    public $orderNo;
    public $orderAmt;
    public $createdDate;
    public $updatedDate;
    
    public function __construct($billNo = null,$orderId = null, 
            $orderNo = null,$orderAmt = null) {
        
        $this->orderId = $orderId;
        $this->billNo = $billNo;
        $this->orderNo = $orderNo;
        $this->orderAmt = $orderAmt;
      
        
    }
    
}
