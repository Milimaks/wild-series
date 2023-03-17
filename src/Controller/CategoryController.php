<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;




#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/{categoryName}', name: 'show')]
    public function show(string $categoryName, CategoryRepository $categoryRepository, ProgramRepository $programsRepository): Response
    {
        $category = $categoryRepository->findOneBy(['name' => $categoryName]);

        if (!$category) {
            throw $this->createNotFoundException(
                'No category with categoryName : ' . $categoryName . 'found in category\'s table'
            );
        }

        $programs = $programsRepository->findBy(['category' => $category], ['id' => 'DESC']);

        return $this->render(
            'category/_show.html.twig',
            [
                'category' => $category,
                'programs' => $programs,
            ]
        );
    }
    
    // #[Route('/program/', name: 'program_index')]
    // public function index(): Response
    // {
    //     return $this->render('program/index.html.twig', [
    //         'website' => 'Wild Series',
    //      ]);
    // }

    // #[Route('/show/{id<^[0-9]+$>}', name: 'show')]
    // public function show(int $id, ProgramRepository $programRepository):Response
    // {
    //     $program = $programRepository->findOneBy(['id' => $id]);
    //     // same as $program = $programRepository->find($id);
    
    //     if (!$program) {
    //         throw $this->createNotFoundException(
    //             'No program with id : '.$id.' found in program\'s table.'
    //         );
    //     }
    //     return $this->render('program/_show.html.twig', [
    //         'program' => $program,
    //     ]);
    // }

}

