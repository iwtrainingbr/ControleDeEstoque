<?php

use App\Controller\Api\CategoryApiController;
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
    '/excluir-categoria' => mountRoutes(CategoryController::class, 'remove'),
    '/categorias/pdf' => mountRoutes(CategoryController::class, 'pdf'),

    '/novo-usuario' => mountRoutes(UserController::class, 'add'),
    '/usuarios' => mountRoutes(UserController::class, 'list'),
    '/excluir-usuario' => mountRoutes(UserController::class, 'remove'),
    '/confirmar-excluir-usuario' => mountRoutes(UserController::class, 'confirmRemove'),

    '/novo-produto' => mountRoutes(ProductController::class, 'add'),
    '/produtos' => mountRoutes(ProductController::class, 'list'),

    '/sair' => mountRoutes(IndexController::class, 'logout'),


    //API
    '/api/categoria' => mountRoutes(CategoryApiController::class, 'main'),
];
