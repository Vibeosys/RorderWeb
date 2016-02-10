<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\ORM\Table;
use App\DTO\UploadDTO;
use Cake\Log\Log;

/**
 * Description of TaxTable
 *
 * @author niteen
 */
class TaxTable extends Table {

    private function connect() {
        return TableRegistry::get('taxes');
    }

    public function getTaxes() {
        $taxList[] = null;
        $taxListCounter = 0;
        $taxResults = $this->connect()->find()->where(['Active =' => 1]);
        if ($taxResults->count()) {
            foreach ($taxResults as $taxResult) {
                $taxUploadDto = new UploadDTO\TaxUploadDto(
                        $taxResult->TaxId, 
                        $taxResult->TaxTitle, 
                        $taxResult->Percentage);
                $taxList[$taxListCounter++] = $taxUploadDto;
                //Log::debug('All taxes are retrived from tax table result count : '.$taxResults->count());
            }
        }
        return $taxList;
    }

}
