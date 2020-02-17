<?php

declare(strict_types=1);

namespace App\Controller;

use App\Adapter\Connection;
use App\Entity\Category;
use Doctrine\ORM\EntityManager;

class CategoryController extends AbstractController
{
    private EntityManager $entityManager;
    private $repository;

    public function __construct()
    {
        $this->entityManager = Connection::getEntityManager();
        $this->repository = $this->entityManager->getRepository(Category::class);
    }

    public function add():void
    {
        if ($_POST) {
            $category = new Category();
            $category->setName($_POST['name']);
            $category->setDescription($_POST['description']);

            $this->entityManager->persist($category);
            $this->entityManager->flush();

            header('location: /categorias');
        }

        $this->render('category/add');
    }

    public function list():void
    {
        $categories = $this->repository->findAll();

        $this->render('category/list', [
            'categories' => $categories,
        ]);
    }
}
