<?php
namespace App\Model\Table;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Cake\ORM\TableRegistry;
use Cake\ORM\Table;
use Cake\Log\Log;
use App\DTO\UploadDTO;
/**
 * Description of BillDetailsTable
 *
 * @author niteen
 */
class BillDetailsTable extends Table{
    
    
    public function connect() {
        return TableRegistry::get('bill_details');
    }
}
