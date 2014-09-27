<?php

require_once __DIR__.'/vendor/autoload.php';

use DtvFbapp\Console\Command\DatabaseCreateTablesCommand;
use DtvFbapp\Console\Command\DatabaseDropTablesCommand;
use Gecky\Console\Application;

$application = new Application();
$application->add(new DatabaseCreateTablesCommand());
$application->add(new DatabaseDropTablesCommand());
$application->run();