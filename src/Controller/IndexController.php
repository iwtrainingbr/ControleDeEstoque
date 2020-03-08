<?php

declare(strict_types=1);

namespace App\Controller;

use App\Adapter\Connection;
use App\Entity\Category;
use App\Entity\Product;
use App\Entity\User;

class IndexController extends AbstractController
{
    private $entityManager;

    public function __construct()
    {
        $this->entityManager = Connection::getEntityManager();
    }

    public function login():void
    {
        if (isset($_SESSION['user_logged'])) {
            header('location: /dashboard');
            return;
        }

        if (!$_POST) {
            $this->render('index/login');
            return;
        }

        $user = $this
            ->entityManager
            ->getRepository(User::class)
            ->findOneBy(['email' => $_POST['email']]);

        if (!$user) {
            $_SESSION['error'] = ['Usuário não encontrado'];
            header('location: /');
            return;
        }

        if (!password_verify($_POST['password'], $user->getPassword())) {
            $_SESSION['error'] = ['Senha incorreta'];
            header('location: /');
            return;
        }

        $_SESSION['user_logged'] = [
            'name' => $user->getName(),
            'id' => $user->getId(),
        ];

        $_SESSION['success'] = ['Bem vindo, '.$user->getName()];
        header('location: /');
    }

    public function dashboard():void
    {
        $users = $this->entityManager->getRepository(User::class)->findAll();
        $categories = $this->entityManager->getRepository(Category::class)->findAll();
        $products = $this->entityManager->getRepository(Product::class)->findAll();

        $this->render('index/dashboard', [
            'qtd_users' => count($users),
            'qtd_categories' => count($categories),
            'qtd_products' => count($products),
        ]);
    }

    public function logout(): void
    {
        session_destroy();
        header('location: /');
    }
}
