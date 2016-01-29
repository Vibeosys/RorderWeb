<?php
namespace App\DTO\UploadDTO;


use App\DTO;
/**
 * Description of BillDetailsUploadDto
 *
 * @author niteen
 */
class BillDetailsUploadDto extends DTO\JsonDeserializer{
    
    public $autoId;
    public $orderId;
    public $billNo;
    public $createdDate;
    public $updatedDate;
    
    public function __construct($autoId = null, $orderId = null, $billNo = null, $createdDate = null, $updatedDate = null) {
        
        $this->autoId = $autoId;
        $this->orderId = $orderId;
        $this->billNo = $billNo;
        $this->createdDate = $createdDate;
        $this->updatedDate = $updatedDate;
        
    }
    
}
