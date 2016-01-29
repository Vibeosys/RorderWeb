<?php
namespace App\DTO\UploadDTO;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use App\DTO;
/**
 * Description of BillUploadDto
 *
 * @author niteen
 */
class BillUploadDto extends DTO\JsonDeserializer{
    
    public $billNo;
    public $billDate;
    public $billTime;
    public $netAmount;
    public $totalTaxAmount;
    public $totalPayAmount;
    public $createdDate;
    public $updatedDate;
    public $userId;
    
    public function __construct($billNo = null, $billDate = null, $billTime = null, $netAmount = null, $totalTaxAmount = null, $totalPayAmount = null, $createdDate = null, $updatedDate = null, $userId = null) {

        $this->billNo = $billNo;
        $this->billDate = $billDate;
        $this->billTime = $billTime;
        $this->netAmount = $netAmount;
        $this->totalTaxAmount = $totalTaxAmount;
        $this->totalPayAmount = $totalPayAmount;
        $this->createdDate = $createdDate;
        $this->updatedDate = $updatedDate;
        $this->userId = $userId;
    }
}
