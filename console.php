<?php

require_once __DIR__.'/vendor/autoload.php';

use Odiseo\ViolettaPromo\Console\Command\DatabaseCreateTablesCommand;
use Odiseo\ViolettaPromo\Console\Command\DatabaseDropTablesCommand;
use Gecky\Console\Application;

$application = new Application();
$application->add(new DatabaseCreateTablesCommand());
$application->add(new DatabaseDropTablesCommand());
$application->run();