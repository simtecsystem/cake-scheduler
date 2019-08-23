<?php
/**
 * Created by Li
 * Website: www.watchowl.io
 * Date: 2/10/17
 * Time: 7:32 PM
 */

namespace CakeScheduler\Schedule;

use Cake\Core\Configure;
use Crunz\Schedule;

class CakeSchedule extends Schedule
{
    public function shell($command)
    {
        return $this->run(Configure::read('CakeScheduler.phpBinary') . ' ' . ROOT . DS . 'bin' . DS . 'cake ' . $command);
    }

    public function run($command, array $parameters = [])
    {
        $this->loadCakeBootstrapFile();

        return parent::run($command, $parameters);
    }

    private function loadCakeBootstrapFile()
    {
        $root = ROOT;

        if (!file_exists($root . '/config/bootstrap.php')) {
            throw new \Exception('bootstrap.php file is missing from config');
        }

        require_once $root . '/config/bootstrap.php';
    }
}
