<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class CategoryFixtures extends Fixture
{
    const CATEGORIES = [
        'Action',
        'Animation',
        'Aventure',
        'Comédie',
        'Drame',
        'Epouvante-horreur',
        'Fantastique',
        'Policier',
        'Romance',
        'Science-fiction',
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::CATEGORIES as $key => $categoryName) {  
            $category = new Category();  
            $category->setName($categoryName);  
            $manager->persist($category);  
        }  
        $manager->flush();
    }
}