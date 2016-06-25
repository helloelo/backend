<?php

namespace Helloelo\Api\V1;


use Helloelo\Api\ClientException;
use Yaoi\Command;
use Yaoi\Command\Definition;

class Login extends Command
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
        if (!isset($_COOKIE['session_id'])) {
            throw new ClientException('Missing session id');
        }
        
        $this->sessionId = $_COOKIE['session_id'];
    }


}