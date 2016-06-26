<?php

namespace Helloelo\Api\V1;

use Helloelo\Entity\Game;
use Helloelo\Entity\Organization;
use Helloelo\Entity\Player;
use Yaoi\Command;
use Yaoi\Command\Definition;

class Games extends AuthRequired
{

    /**
     * @param Definition $definition
     * @param \stdClass|static $options
     */
    static function setUpDefinition(Definition $definition, $options)
    {
    }

    public function performAction()
    {
        $player = Player::findByPrimaryKey($this->playerId);
        $organization = Organization::findByPrimaryKey($player->fkOrganization);

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
            $game->fkOrganization = $organization->idOrganization;
            $game->findOrSave();

            $result []= $game->toArray();
        }

        return $result;
    }

}