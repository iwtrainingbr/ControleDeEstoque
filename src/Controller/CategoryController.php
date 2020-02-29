<?php

declare(strict_types=1);

namespace App\Controller;

use App\Adapter\Connection;
use App\Entity\Category;
use Doctrine\ORM\EntityManager;
use Dompdf\Dompdf;

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

            $_SESSION['success'] = ['Nova Categoria criada'];

            header('location: /categorias');
            return;
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

    public function remove(): void
    {
        $id = $_GET['id'];

        $category = $this->repository->find($id);

        $this->entityManager->remove($category);
        $this->entityManager->flush();

        $_SESSION['error'] = ["Categoria {$category->getName()} foi removida"];

        header('location: /categorias');
    }

    public function pdf(): void
    {
        $today = new \DateTime();

        $categories = $this->repository->findAll();

        $tbody = '';
        foreach ($categories as $category) {
            $tbody .= "
            <tr>
                <td>{$category->getId()}</td>
                <td>{$category->getName()}</td>
                <td>{$category->getDescription()}</td>
            </tr>
            ";
        }

        $html = "
            <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css'>
            <h1>Relatório de Categorias</h1>
            
            <hr>
            <div class='alert alert-success'>
                <strong>Gerado por </strong> Chiquim das Tapiocas<br>
                <strong>Gerado em </strong> {$today->format('d/m/Y \a\s H:i:s')}
            </div>
            <hr>
            
            <table class='table table-striped'>
                <thead class='thead-dark'>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                    </tr>
                </thead>
                
                <tbody>{$tbody}</tbody>
            </table>    
            
            <br>
            <a href='https://google.com'>Fale com o administrador</a>
        ";

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        //$dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('Relatorio-Categorias-'.$today->format('dmY').'.pdf', [
            'Attachment' => false,
        ]);
    }
}
