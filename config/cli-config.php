<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use App\Adapter\Connection;

require_once dirname(__DIR__).'/vendor/autoload.php';
require_once 'database.php';

$entityManager = Connection::getEntityManager();

return ConsoleRunner::createHelperSet($entityManager);
