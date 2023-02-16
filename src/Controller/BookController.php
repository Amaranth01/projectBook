<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Category;
use App\Entity\Shelf;
use Doctrine\ORM\EntityManagerInterface;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/book')]
class BookController extends AbstractController
{
    #[Route('/', name: 'app_book')]
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
    #[Route('/add', name: 'add')]
    public function addBook(EntityManagerInterface $em): Response {
        $book = new Book();
        $book
            ->setTitle("")
            ->setAuthor("")
            ->setBorrower(1)
            ->setCategory(4)
            ->setResume("")
        ;

        $em->persist($book);
        $em->flush();

        return self::index($em);
    }
    #[Route('/delete/{id}', name: 'delete')]
    public function deleteBook(Book $book, EntityManagerInterface $em): Response {
        $em->remove($book);
        $em->flush();
        return self::index($em);
    }

    #[Route('/update/{id}', name: 'update')]
    public function updateBook(Book $book, EntityManagerInterface $em): Response {
        $book
            ->setTitle("")
            ->setResume("")
            ->setBorrower(1)
        ;

        $em->flush();

        return self::index($em);
    }
}