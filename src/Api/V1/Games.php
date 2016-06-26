<?php

namespace Helloelo\Api\V1;

use Helloelo\Entity\Game;
use Helloelo\Entity\Player;
use Yaoi\Command;
use Yaoi\Command\Definition;

class Games extends Command
{
    public $organizationId;

    /**
     * @param Definition $definition
     * @param \stdClass|static $options
     */
    static function setUpDefinition(Definition $definition, $options)
    {
        $options->organizationId = Command\Option::create()->setType()->setIsRequired();
    }

    public function performAction()
    {
        $namez = array(
            'Rock, paper, scissor',
            'Street Fighter',
            'Ping Pong',
            'Foosball',
        );
        $result = array();

        // mock dat shit
        foreach ($namez as $name) {
            $game = new Game();
            $game->name = $name;
            $game->fkOrganization = $this->organizationId;
            $game->findOrSave();

            $result []= $game->toArray();
        }

        return $result;
    }

}