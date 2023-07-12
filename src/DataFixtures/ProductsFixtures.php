<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProductsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');

        for ($i=1; $i <21 ; $i++) { 
          
            $categorie =$this->getReference('categorie_'.$faker->numberBetween(1,10));

            $product=new Product();
            $product->setCategory($categorie)
            ->setName($faker->words(3, true))
            ->setDescription($faker->paragraph(2))
            ->setPrice($faker->randomFloat(2, 1000, 50000))
            ->setSubtitle($faker->words(3, true));
           // ->setSlug($product->getName())
            //->setIllustration($faker->imageUrl(640, 480, 'Produit', true));
           // $faker2=$faker->image('C:\laragon\www\myBoutique\public\uploads\images', 640, 480);
           
            //dd($str);
            $product->setIllustration($faker->image('C:\laragon\www\myBoutique\public\uploads\images', 360, 360, 'animals', false, true, 'cats', true));

          //  $product ->setIllustration($faker->image('C:\laragon\www\myBoutique\public\uploads\images', 640, 480));

            $manager->persist($product);
        }



        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
