<?php
namespace App\DTO\UploadDTO;

/**
 * Description of CustomerOrderListDto
 *
 * @author niteen
 */
class CustomerOrderListDto {
    
    public $orderId;
    public $orderNo;
    public $orderAmt;
    public $userId;
    public $tableId;
    
    public function __construct($orderId =null, $orderNo = null, $orderAmt = null, $userId = null, $tableId = null) {
        $this->orderId  =$orderId;
        $this->orderNo = $orderNo;
        $this->orderAmt = $orderAmt;
        $this->userId = $userId;
        $this->tableId = $tableId;
    }
    
    
}
