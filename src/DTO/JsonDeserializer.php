<?php
namespace App\DTO;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of JsonDeserializer
 *
 * @author niteen
 */
abstract class JsonDeserializer
{
    
    /**
     * @param string|array $json
     * @return $this
     */
    public static function Deserialize($json)
    {
      
        $className = get_called_class();
        $classInstance = new $className();
        if (is_string($json)) {
            $json = json_decode($json);
        }
        
       // \Cake\Log\Log::debug("upload json : ".$json);
        
        foreach ($json as $key => $value) {
            if (!property_exists($classInstance, $key)) {
                continue;
            }

            $classInstance->{$key} = $value;
           
        }

        return $classInstance;
    }
    /**
     * @param string $json
     * @return $this[]
     */
    public static function DeserializeArray($json)
    {
        $json = json_decode($json);
        $items = [];
        foreach ($json as $item) {
            $items[] = self::Deserialize($item);
        }
        return $items;
    }
}