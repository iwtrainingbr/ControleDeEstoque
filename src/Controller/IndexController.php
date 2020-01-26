<?php

declare(strict_types=1);

class IndexController extends AbstractController
{
  public function login(): void
  {
      $this->render('index/login');
  }

  public function dashboard(): void
  {
      $this->render('index/dashboard');
  }
}
