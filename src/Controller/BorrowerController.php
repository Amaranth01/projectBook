<?php

namespace App\Controller;

use App\Entity\Borrower;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/borrower')]
class BorrowerController extends AbstractController
{
    #[Route('/', name: 'app_borrower')]
    public function index(): Response
    {
        return $this->render('borrower/index.html.twig', [
            'controller_name' => 'BorrowerController',
        ]);
    }
    #[Route('/add', name: 'add')]
    public function addBorrower(Borrower $borrower, EntityManagerInterface $em) {
        $borrower = new Borrower();
        $borrower
            ->setName("")
            ->setEmail("")
            ->setPassword("")
        ;
        $em->persist($borrower);
        $em->flush();

        return self::index();
    }
    #[Route('/update/{id}', name: 'update')]
    public function updateBorrower(Borrower $borrower, EntityManagerInterface $em) {
        $borrower
            ->setName("")
            ->setEmail("")
            ->setPassword("")
       ;
        return self::index();
    }
    #[Route('/delete/{id}', name: 'delete')]
    public function deleteBorrower(Borrower $borrower, EntityManagerInterface $em) {
        $em->remove($borrower);
        $em->flush();
        return self::index();
    }

}
