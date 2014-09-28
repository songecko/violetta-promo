<?php

require_once __DIR__.'/vendor/autoload.php';

use Doctrine\ORM\Tools\Console\ConsoleRunner;

$gecky = new Gecky\Framework(false);
$em = $gecky->container->get('database')->getEntityManager();

return ConsoleRunner::createHelperSet($em);