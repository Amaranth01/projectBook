<?php

namespace App\Controller;

use App\Entity\Shelf;
use App\Repository\ShelfRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/shelf')]
class ShelfController extends AbstractController
{
    #[Route('/', name: 'app_shelf')]
    public function index(): Response
    {
        return $this->render('shelf/index.html.twig', [
            'controller_name' => 'ShelfController',
        ]);
    }

    #[Route('/add', name: 'add')]
    public function addShelf(EntityManagerInterface $em): Response {
        $shelf = new Shelf();
        $shelf
            ->setName("");
        ;
        $em->persist($shelf);
        $em->flush();

        return self::index();
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function deleteShelf(Shelf $shelf, EntityManagerInterface $em): Response {
        $em->remove($shelf);
        $em->flush();
        return self::index();
    }

    #[Route('/update/{id}', name: 'update')]
    public function updateShelf(Shelf $shelf, EntityManagerInterface $em): Response {
        $shelf->setName('');
        $em->flush();
        return self::index();
    }

}
