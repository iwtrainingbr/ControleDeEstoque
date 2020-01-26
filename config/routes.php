<?php

function mountRoute(string $controller, string $method): array
{
  return [
    'controller' => $controller,
    'method' => $method,
  ];
}

return [
  '/' => mountRoute('IndexController', 'login'),
  '/dashboard' => mountRoute('IndexController', 'dashboard'),
  '/categorias' => mountRoute('CategoryController', 'list'),
  '/nova-categoria' => mountRoute('CategoryController', 'add'),
];
