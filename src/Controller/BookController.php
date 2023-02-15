<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Category;
use App\Entity\Shelf;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    #[Route('/book', name: 'app_book')]
    public function index(EntityManagerInterface $em): Response
    {
        $books = $em->getRepository(Book::class)->findAll();
        $shelf = $em->getRepository(Shelf::class)->findAll();
        $category = $em->getRepository(Category::class)->findAll();
        return $this->render('book/index.html.twig', [
            "books" => $books,
            "shelfs" => $shelf,
            "categories" => $category,
        ]);
    }
}