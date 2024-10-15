<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route('/menu', name: 'app_menu')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        // Retrieves all categories with their associated products
        $categories = $categoryRepository->findAll();

        // Renders the view with the categories and products
        return $this->render('menu/index.html.twig', [
            'categories' => $categories,
        ]);
    }
}