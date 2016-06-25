<?php

namespace Helloelo\Api\V1;

use Yaoi\Command;

abstract class AuthRequired extends Command
{
    const TOKEN = 'token';
    public $playerId;

}