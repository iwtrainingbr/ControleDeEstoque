<?php

use App\Adapter\Connection;
use App\Entity\User;

include dirname(__DIR__).'/vendor/autoload.php';
include dirname(__DIR__).'/config/database.php';

$entityManager = Connection::getEntityManager();

$user = new User();
$user->setName('Administrador Padrão');
$user->setEmail('admin@admin.com');
$user->setPassword(
    password_hash('12345678', PASSWORD_ARGON2I)
);
$user->setStatus(true);

$entityManager->persist($user);
$entityManager->flush();

echo PHP_EOL."===============================================".PHP_EOL;
echo PHP_EOL."=== Usuário admin@admin.com criado com senha 12345678".PHP_EOL;
echo PHP_EOL."===============================================".PHP_EOL;
