<?php
/**
 * @author Nicolas CARPi <nicolas.carpi@curie.fr>
 * @copyright 2012 Nicolas CARPi
 * @see https://www.elabftw.net Official website
 * @license AGPL-3.0
 * @package elabftw
 */
namespace Elabftw\Commands;

use Elabftw\Elabftw\Sql;
use Elabftw\Models\Config;
use Elabftw\Elabftw\Update;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Update the database schema
 */
class UpdateDatabase extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'db:update';

    protected function configure()
    {
         $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Update the database structure')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to update the structure of the database to the latest version.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $command = $this->getApplication()->find('db:check');

        $arguments = array(
            'command' => 'db:check'
        );

        $cmdInput = new ArrayInput($arguments);
        $returnCode = $command->run($cmdInput, $output);

        if ($returnCode === 1) {
            $output->writeln(array(
                'Database update starting',
                '========================',
            ));

            $Config = new Config();
            $Update = new Update($Config, new Sql());
            $Update->runUpdateScript();
            $output->writeln('All done.');
        }

    }
}
