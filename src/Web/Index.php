<?php

namespace Helloelo\Web;

use Helloelo\Api\V1;
use Yaoi\Command\Application;
use Yaoi\Command\Definition;

class Index extends Application
{
    public $v1;

    /**
     * @param Definition $definition
     * @param \stdClass|static $commandDefinitions
     */
    static function setUpCommands(Definition $definition, $commandDefinitions)
    {
        $commandDefinitions->v1 = V1::definition();
    }


}