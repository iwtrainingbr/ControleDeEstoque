<?php

declare(strict_types=1);

namespace App\Adapter;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

class Connection
{
  public static function getEntityManager(): EntityManager
  {
    $params = [
      'driver' => DB_DRIVER,
      'user' => DB_USER,
      'password' => DB_PASS,
      'dbname' => DB_NAME,
    ];

    $paths = [
      dirname(__DIR__).'/Entity',
    ];

    $config = Setup::createAnnotationMetadataConfiguration($paths, true);

    return EntityManager::create($params, $config);
  }
}
