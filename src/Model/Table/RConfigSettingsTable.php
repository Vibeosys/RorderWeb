<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use App\DTO\DownloadDTO;
use Cake\Log\Log;
/**
 * Description of RConfigSettingsTable
 *
 * @author niteen
 */
class RConfigSettingsTable extends Table{
    
    public function connect() {
        return TableRegistry::get('r_config_settings');
    }
    
    public function getSettings($restaurantId) {
        $conditions = ['RestaurantId = ' => $restaurantId];
        $allConfigSettings = null;
        $settingCounter = 0;
        try{
            $configSettings = $this->connect()->find()->where($conditions);
            if($configSettings->count()){
                foreach ($configSettings as $setting){
                    $allConfigSettings[$settingCounter++] = 
                            new DownloadDTO\RConfigSettingsDownloadDto(
                                    $setting->ConfigKey, $setting->ConfigValue);
                }
            }
            return $allConfigSettings;
        } catch (Exception $ex) {
            return null;
        }
    }
    
    public function settingAllowed($restaurantId , $configKey) {
        $conditions = ['RestaurantId =' => $restaurantId, 'ConfigKey =' => $configKey];
        $result = $this->connect()->find('all',array('fields' => array('ConfigValue'),'conditions' => $conditions))->toArray();
        if(!count($result)){
            return FALSE;
        }elseif ($result[0]->ConfigValue) {
            return TRUE;
        }  else {
            return FALSE;
        }
    }
}
