<?php

namespace Helloelo\Api\V1;


use Helloelo\Entity\Organization;
use Helloelo\Entity\Player;
use Yaoi\Command;
use Yaoi\Command\Definition;

class Init extends AuthRequired
{
    public $sessionId;

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
        return array('player' => $player->toArray(), 'organization' => $organization->toArray());
    }


}