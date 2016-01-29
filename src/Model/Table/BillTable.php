<?php
namespace App\Model\Table;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
use App\DTO\UploadDTO;
/**
 * Description of BillTable
 *
 * @author niteen
 */
class BillTable extends Table{
    
    public function connect() {
        
        return TableRegistry::get('bill');
    }
    
    
    
}
