<?php

declare(strict_types=1);

class CategoryController extends AbstractController
{
    public function add():void
    {
        $this->render('category/add');
    }

    public function list():void
    {
        $this->render('category/list');
    }
}