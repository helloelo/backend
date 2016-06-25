<?php

namespace Helloelo;

use Helloelo\Web\Index;
use Yaoi\Twbs\Runner;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../env/conf.php';

Runner::create()->run(Index::definition());