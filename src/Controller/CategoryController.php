<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/category')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'app_category')]
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }
    #[Route('/add', name: 'add')]
    public function addCategory(Category $category, EntityManagerInterface $em): Response {
        $category = new Category();
        $category
            ->setName("")
            ->setShelf(3)
        ;
        $em->persist($category);
        $em->flush();
        return self::index();
    }
    #[Route('/update/{id}', name: 'update')]
    public function updateCategory(Category $category, EntityManagerInterface $em): Response {
        $category
            ->setName("");
        $em->flush();
        return self::index();
    }
    #[Route('/delete/{id}', name: 'delete')]
    public function deleteCategory(Category $category, EntityManagerInterface $em): Response {
        $em->remove($category);
        $em->flush();
        return self::index();
    }

}
