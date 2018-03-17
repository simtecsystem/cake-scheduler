<?php
/**
 * Created by Li
 * Website: www.watchowl.io
 * Date: 2/10/17
 * Time: 7:32 PM
 */

namespace CakeScheduler\Shell;

use Cake\Console\Shell;
use Crunz\Console\CommandKernel;
use Crunz\ErrorHandler;
use Symfony\Component\Console\Input\ArgvInput;

/**
 * CakeScheduler shell command.
 */
class CakeSchedulerShell extends Shell
{
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();

        $parser->addSubcommand('run', [
            'parser' => [
                'description' => [
                    __('Run the scheduler'),
                ]
            ]
        ]);

        $parser->addSubcommand('view', [
            'parser' => [
                'description' => [
                    __('List of scheduled cron jobs'),
                ]
            ]
        ]);

        return $parser;
    }

    public function main()
    {
        $this->out($this->OptionParser->help());
        return true;
    }

    public function run()
    {
        echo $this->runCrunzCommand(new ArgvInput(['crunz', 'schedule:run', './schedule']));
        echo PHP_EOL;
    }

    public function view()
    {
        echo $this->runCrunzCommand(new ArgvInput(['crunz', 'schedule:list', './schedule']));
        echo PHP_EOL;
    }
    
    private function runCrunzCommand(ArgvInput $input) {
        ErrorHandler::getInstance()->set();
        $kernel = new CommandKernel('Crunz Command Line Interface', 'v1.4.0');
        $kernel->run($input);
    }
}
