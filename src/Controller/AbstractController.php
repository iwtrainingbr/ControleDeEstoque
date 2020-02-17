<?php

declare(strict_types=1);

namespace App\Controller;

abstract class AbstractController
{
    public function render(string $view, array $data = []): void
    {
        include_once "../src/View/template/head.phtml";
        include_once "../src/View/template/navbar.phtml";
        include_once "../src/View/{$view}.phtml";
        include_once "../src/View/template/footer.phtml";
    }
}
