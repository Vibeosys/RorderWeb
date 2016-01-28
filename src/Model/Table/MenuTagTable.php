<?php
namespace App\Model\Table;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use App\DTO\DownloadDTO;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
/**
 * Description of MenuTagTable
 *
 * @author niteen
 */
class MenuTagTable extends Table{
    
    private function connect() {
        return TableRegistry::get('menu_tags')
                ;
    }
    public function getMenuTag() {
        $menuTags = $this->connect()->find();
        $count = $menuTags->count();
        if(!$count){
            Log::debug('Menu Tags are not found');
            return false;
        }
        $allMenuTags[] = null;
        $i = 0;
        foreach ($menuTags as $tag){
            
            $menuTagDto = new DownloadDTO\MenuTagDownloadDto($tag->TagId, $tag->TagTitle);
            $allMenuTags[$i] = $menuTagDto;
            $i++;
        }
         Log::debug('Menu Tags are successfully return');
        return $allMenuTags;
    }
}
