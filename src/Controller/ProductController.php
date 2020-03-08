<?php

declare(strict_types=1);

namespace App\Controller;

use App\Adapter\Connection;
use App\Entity\Category;
use App\Entity\Product;

class ProductController extends AbstractController
{
    private $entityManager;

    public function __construct()
    {
        $this->entityManager = Connection::getEntityManager();
    }

    public function add():void
    {
        if ($_POST) {
            $category = $this->entityManager->getRepository(Category::class)->find($_POST['category']);

            $product = new Product();
            $product->setName($_POST['name']);
            $product->setDescription($_POST['description']);
            $product->setQuantity((int) $_POST['quantity']);
            $product->setCategory($category);

            $this->entityManager->persist($product);
            $this->entityManager->flush();

            $_SESSION['success'] = ['Novo Produto criado'];
            header('location: /produtos');
            return;
        }

        $categories = $this
            ->entityManager
            ->getRepository(Category::class)
            ->findAll();

        $this->render('product/add', [
            'categories' => $categories,
        ]);
    }

    public function list():void
    {
        $products = $this->entityManager->getRepository(Product::class)->findAll();

        $this->render('product/list', [
            'products' => $products,
        ]);
    }

}
