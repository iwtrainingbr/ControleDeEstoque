<?php

declare(strict_types=1);

namespace App\Controller;

use App\Adapter\Connection;
use App\Entity\User;
use Doctrine\ORM\EntityManager;

class UserController extends AbstractController
{
    private EntityManager $entityManager;
    private $repository;

    public function __construct()
    {
        $this->entityManager = Connection::getEntityManager();
        $this->repository = $this->entityManager->getRepository(User::class);
    }

    public function add():void
    {
        if ($_POST) {
            $user = new User();
            $user->setName($_POST['name']);
            $user->setEmail($_POST['email']);
            $user->setStatus(true);
            $user->setPassword(
                password_hash($_POST['password'], PASSWORD_ARGON2I)
            );

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            header('location: /usuarios');
        }

        $this->render('user/add');
    }

    public function list(): void
    {
        $users = $this->repository->findAll();

        $this->render('user/list', [
            'users' => $users,
        ]);
    }

    public function remove(): void
    {
        $user = $this->repository->find($_GET['id']);
    }
}
