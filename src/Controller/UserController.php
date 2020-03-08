<?php

declare(strict_types=1);

namespace App\Controller;

use App\Adapter\Connection;
use App\Entity\User;
use App\Security\UserPermission;
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
        UserPermission::needUserLogged();

        if ($_POST) {
            if (trim($_POST['name']) === '') {
                $_SESSION['error'] = ['Nome é obrigatório'];
                header('location: /novo-usuario');
                return;
            }

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
        UserPermission::needUserLogged();

        $users = $this->repository->findAll();

        $this->render('user/list', [
            'users' => $users,
        ]);
    }

    public function remove(): void
    {
        UserPermission::needUserLogged();

        $user = $this->repository->find($_GET['id']);

        $this->entityManager->remove($user);
        $this->entityManager->flush();

        $_SESSION['success'] = ["Usuário {$user->getName()} foi removido"];

        header('location: /usuarios');
    }

    public function confirmRemove(): void
    {
        UserPermission::needUserLogged();

        $user = $this->repository->find($_GET['id']);

        $this->render('user/confirm-remove', [
            'user' => $user,
        ]);
    }
}
