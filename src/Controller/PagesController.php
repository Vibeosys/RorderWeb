<?php
namespace App\Controller;
use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
class PagesController extends AppController {

    public function display() {
        $path = func_get_args();

        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));

        try {
            $this->render(implode('/', $path));
        } catch (MissingTemplateException $e) {
            if (Configure::read('debug')) {
                throw $e;
            }
            throw new NotFoundException();
        }
    }

    public function rorderHome() {
        echo Configure::version();
        return;
    }

    public function error() {
        
    }

    public function insertMasterData() {
        $this->autoRender = false;
        $connect = mysql_connect('192.168.1.6', 'dev', 'dev');
        if (!$connect) {
            die('Could not connect to MySQL: ' . mysql_error());
        }
        $cid = mysql_select_db('RestaurantDB', $connect);
        define('CSV_PATH', 'C:/Users/Niteen/Desktop/');
        $csv_file = CSV_PATH . "test.csv";
        if (($handle = fopen($csv_file, "r")) !== FALSE) {
            fgetcsv($handle);
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                for ($c = 0; $c < $num; $c++) {
                    $col[$c] = $data[$c];
                }
                $col1 = $col[0];
                $col2 = $col[1];
                $col3 = $col[2];
                $col4 = $col[3];
                $col5 = $col[4];
                $col6 = $col[5];
                $col7 = $col[6];
                $col8 = $col[7];
                $query = "INSERT INTO menu_categoty(CategoryId,CategoryTitle,CategoryImage,Active,CreatedDate,UpdatedDate,Color,RestaurantId) VALUES"
                        . "(" . $col1 . ",'" . $col2 . "','" . $col3 . "'," . $col4 . ",'" . $col5 . "','" . $col6 . "','" . $col7 . "'," . $col8 . ")";
                $s = mysql_query($query, $connect);
            }
            fclose($handle);
        }
        $this->response->body("File data successfully imported to database!!");
        mysql_close($connect);
    }
}
