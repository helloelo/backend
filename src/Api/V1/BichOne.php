<?php

namespace Helloelo\Api\V1;

use Yaoi\Command;
use Yaoi\Command\Definition;

class BichOne extends Command
{
    static function setUpDefinition(Definition $definition, $options)
    {
    }

    public function performAction()
    {
        return array('bich' => 'one');
    }


}