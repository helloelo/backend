<?php

namespace Helloelo\Command;


use Helloelo\Entity\Elo;
use Helloelo\Entity\Game;
use Helloelo\Entity\Match;
use Helloelo\Entity\Notification;
use Helloelo\Entity\Organization;
use Helloelo\Entity\Player;
use Helloelo\Entity\Session;
use Yaoi\Command;
use Yaoi\Command\Definition;
use Yaoi\Database\Definition\Table;
use Yaoi\Log;

class Migrate extends Command
{
    public $wipe;
    public $dryRun;

    static function setUpDefinition(Definition $definition, $options)
    {
        $options->wipe = Command\Option::create()->setDescription('Recreate tables');
        $options->dryRun = Command\Option::create()->setDescription('Read-only mode');
        $definition->name = 'migrate';
        $definition->description = 'Actualize application data schema';
    }

    public function performAction()
    {
        /** @var Table[] $tables */
        $tables = array(
            Elo::table(),
            Game::table(),
            Match::table(),
            Notification::table(),
            Organization::table(),
            Player::table(),
            Session::table(),
        );

        $log = new Log('colored-stdout');
        if ($this->wipe) {
            foreach ($tables as $table) {
                $table->migration()->setLog($log)->setDryRun($this->dryRun)->rollback();
            }
        }
        foreach ($tables as $table) {
            $table->migration()->setLog($log)->setDryRun($this->dryRun)->apply();
        }
    }


}