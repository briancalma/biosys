<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;
use Cake\Filesystem\File;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{   

    public function initialize() {
        parent::initialize();
        // $this->Auth->allow(['']);
        $this->loadModel('Logs'); 
    }

    public function beforeRender(Event $event) {
        $this->viewBuilder()->setLayout('main');
    }

    /**
     * Displays a view
     *
     * @param array ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\Http\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function display(...$path)
    {   
        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
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
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }

    }

    public function home() {
        
        // $file = fopen(WWW_ROOT.'/file/GLogData_.txt','r');
        // $lines = file(WWW_ROOT.'/file/GLogData_.txt');

        // $logs = [];

        // array_shift($lines);

        // foreach($lines as $line) {
        //     $temp = preg_split('/\s+/', $line);
            
        //     $holder = [
        //                 "id" => $temp[0],
        //                 "employee_id" => $temp[2],
        //                 "log_date" => $temp[7],
        //                 "time" => $temp[8]
        //               ];

            
            
        //     array_push($logs, $holder);
        //     // debug($temp);
        // }

        // // debug($logs);

        // foreach($logs as $log) {
            
        //     $log_item = $this->Logs->newEntity();

        //     $new_log = [
        //         "user_id" => $log["employee_id"],
        //         "log_date" => $log["log_date"], 
        //         "time" => $log["time"]
        //     ];

        //     $log_item = $this->Logs->patchEntity($log_item, $new_log);
        //     $this->Logs->save($log_item);
        // }

        // exit();
        
        
        $user = $this->Auth->user();
        $page = $this->setPageVariables('Home', 'Dashboard');   
        $this->set(compact('user'));
        $this->set(compact('page'));
        // exit();
    }

    public function setPageVariables($title, $subtitle) {
        return [
            "title" =>  $title,
            "sub_title" => $subtitle
        ];
    }
}