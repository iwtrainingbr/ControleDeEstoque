<?php

use App\Controller\IndexController;
use App\Controller\CategoryController;
use App\Controller\ProductController;
use App\Controller\UserController;

function mountRoutes(string $controller, string $method): array
{
    return [
        'controller' => $controller,
        'method' => $method,
    ];
}


return[
    '/' => mountRoutes(IndexController::class, 'login'),
    '/dashboard' => mountRoutes(IndexController::class, 'dashboard'),
    '/categorias' => mountRoutes(CategoryController::class, 'list'),
    '/nova-categoria' => mountRoutes(CategoryController::class, 'add'),
    '/novo-usuario' => mountRoutes(UserController::class, 'add'),
    '/usuarios' => mountRoutes(UserController::class, 'list'),
    '/novo-produto' => mountRoutes(ProductController::class, 'add'),
    '/produtos' => mountRoutes(ProductController::class, 'list'),

];
