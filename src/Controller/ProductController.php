<?php

declare(strict_types=1);

class ProductController extends AbstractController
{
  public function add(): void
  {
    $this->render('product/add');
  }

  public function list(): void
  {
    $this->render('product/list');
  }
}
