<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\Model\Table;
/**
 * Description of RConfigSettingsController
 *
 * @author niteen
 */
define('RCS_INS_QRY', "INSERT INTO r_config_settings (ConfigKey,ConfigValue) "
        . "VALUES (\"@ConfigKey\",\"@ConfigValue\");");
class RConfigSettingsController extends ApiController{
    
    public function getTableObj() {
        return new Table\RConfigSettingsTable();
    }
    
    public function prepareInsertStatement($restaurantId) {
        $allSettings = $this->getTableObj()->getSettings($restaurantId);
        if (!$allSettings) {
            return false;
        }
        $preparedStatements = '';

        foreach ($allSettings as $setting) {
            $preparedStatements .= RCS_INS_QRY;
            $preparedStatements = str_replace('@ConfigKey', $setting->cKey, $preparedStatements);
            $preparedStatements = str_replace('@ConfigValue', $setting->cValue, $preparedStatements);
        }
        return $preparedStatements;
    }
    
    public function allow($restaurantId, $configKey) {
        return $this->getTableObj()->settingAllowed($restaurantId, $configKey); 
    }
    
}
