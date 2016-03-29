<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
   public $components = array('Cookie');
   
   public $colors = [
       '#ff0066','#9900cc','#86b300','#009999'
   ];
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
    
    public function writeCookie($name, $value, $expires = '1 Day', $path = '/') {
        $this->Cookie->configKey($name, ['domain' => DOMAIN,'expires' => $expires ,'path' => $path]);
        $this->Cookie->write($name, $value);
    }
     
    public function readCookie($name) {
        return $this->Cookie->read($name);
    }
     
    public function deleteCookie($name) {
        
        $this->Cookie->configKey($name, ['domain' => DOMAIN,'expires' => '-1 Day' ,'path' => '/']);
        $this->Cookie->write($name, '1');
    }
    
    public function isLogin() {
        $userName = $this->readCookie('un');
        $password = $this->readCookie('pw');
         $restaurantId = $this->readCookie('cri');
         \Cake\Log\Log::debug('request come to check login');
        if(isset($userName) and isset($password) and isset($restaurantId)){
            return TRUE;
        }
        return FALSE;
    }
    
    public function isAuthorised($permissonSet, $permissionKey) {
        if($permissonSet){
            $userPermissions = explode('|', $permissonSet);
            $permissionSetController = new PermissionSetController();
            $permissions = $permissionSetController->getPermissionsStdObj();
            foreach ($userPermissions as $key => $value){
                if($permissions->$value == $permissionKey){
                    return true;
                }
            }
        }
        return FALSE;
    }
}
