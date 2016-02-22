<?php

namespace App\Controller;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use App\Model\Table;
use Cake\Log\Log;
use App\DTO\DownloadDTO;

/**
 * Description of MenuCategoryController
 *
 * @author niteen
 */
define('MC_INS_QRY', "INSERT INTO menu_category (CategoryId,CategoryTitle,CategoryImage,Active,Colour)"
        . " VALUES (@CategoryId,\"@CategoryTitle\",\"@CategoryImage\",@Active,\"@Colour\");");

class MenuCategoryController extends ApiController {

    private function getTableObj() {

        return new Table\MenuCategoryTable();
    }

    public function getMenuCategories() {
        $result = $this->getTableObj()->getMenuCategory();
        if ($result) {
            return $result;
        }
        return false;
    }

    public function prepareInsertStatements() {
        $allMenuCategories = $this->getMenuCategories();
        if (!$allMenuCategories) {
            return false;
        }
        $preparedStatements = '';

        foreach ($allMenuCategories as $menuCategory) {
            $preparedStatements .= MC_INS_QRY;
            $preparedStatements = str_replace('@CategoryId', $menuCategory->categoryId, $preparedStatements);
            $preparedStatements = str_replace('@CategoryTitle', $menuCategory->categoryTitle, $preparedStatements);
            $preparedStatements = str_replace('@CategoryImage', $menuCategory->categoryImage, $preparedStatements);
            $preparedStatements = str_replace('@Active', $menuCategory->active, $preparedStatements);
            $preparedStatements = str_replace('@Colour', $menuCategory->colour, $preparedStatements);
        }
        return $preparedStatements;
    }

    public function addNewMenuCategory() {
        if ($this->request->is('post')) {
            $data = $this->request->data();
            $file = $data['file-upload']['tmp_name'];
            if (empty($file)) {
                $this->set(['message' => SELECT_FILE_MESSAGE,'color' => 'red']);
            } else {
                if (($handle = fopen($file, "r")) !== FALSE) {
                    $counter = 0;
                    $allMenuCategory = null;
                    fgetcsv($handle);
                    while (($filesop = fgetcsv($handle, 1000, ",")) !== false) {
                      $allMenuCategory[$counter] = new DownloadDTO\MenuCategoryDownloadDto(null, $filesop[0], $filesop[1], $filesop[2], $filesop[3]);
                        $counter++;
                    }
                    fclose($handle);
                    $result = $this->getTableObj()->insert($allMenuCategory);
                    if ($result) {
                        $this->set(['message' => 'You database has imported successfully. You have inserted ' . $result . ' recoreds','color' => 'green']);
                    } else {
                        $this->set(['message' => DB_FILE_ERROR,'color' => 'red']);
                    }
                }
            }
        }
    }

}
