<?php


namespace App\Controller\Api;


use App\Adapter\Connection;
use App\Entity\Category;

class CategoryApiController
{
    private $entityManager;

    public function __construct()
    {
        $this->entityManager = Connection::getEntityManager();
    }

    public function main(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if (method_exists(new CategoryApiController(), strtolower($method))) {
            $this->$method();
        }
    }

    public function get(): void
    {
        $categories = $this->entityManager->getRepository(Category::class)->findAll();

        $json = [];

        foreach ($categories as $category) {
            $json[] = $category->getValues();
        }

        echo json_encode($json);

        /*echo json_encode(array_map(function (Category $category) {
            return $category->getValues();
        }, $categories));*/
    }

    public function post(): void
    {
        $json = json_decode(file_get_contents('php://input'));

        $category = new Category();
        $category->setName($json->name);
        $category->setDescription($json->description);

        $this->entityManager->persist($category);
        $this->entityManager->flush();

        echo json_encode([
            'message' => 'Nova categoria criada',
        ]);
    }

    public function put(): void
    {
        $json = json_decode(file_get_contents('php://input'));

        $id = $_GET['id'];

        $category = $this->entityManager->getRepository(Category::class)->find($id);

        $category->setName($json->name);
        $category->setDescription($json->description);

        $this->entityManager->persist($category);
        $this->entityManager->flush();

        echo json_encode([
            'message' => 'Categoria foi atualizada',
        ]);
    }

    public function delete(): void
    {
        $id = $_GET['id'];

        $category = $this->entityManager->getRepository(Category::class)->find($id);

        $this->entityManager->remove($category);
        $this->entityManager->flush();

        echo json_encode([
            'message' => 'Categoria excluida',
        ]);
    }
}