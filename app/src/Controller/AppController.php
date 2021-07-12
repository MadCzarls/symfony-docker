<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Movie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $movie = new Movie();

        return $this->render(
            'test/index.html.twig',
            [
                'controller_name' => 'AppController',
                'testVar' => 'test variable',
            ]
        );
    }

    #[Route('/movies/list', name: 'movies_list')]
    public function list(): Response
    {
        return new Response('TODO');
    }
}
