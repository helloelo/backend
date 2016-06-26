<?php

namespace Helloelo\Api\V1;

use Yaoi\Command;
use Yaoi\Command\Definition;

class ListPlayer extends AuthRequired
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


        return $player;
    }

}