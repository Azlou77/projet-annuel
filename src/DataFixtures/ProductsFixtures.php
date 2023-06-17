<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Products;
use Symfony\Component\String\Slugger\SluggerInterface;
use Faker;

class ProductsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
          // use the factory to create a Faker\Generator instance
          $faker = Faker\Factory::create('fr_FR');

          for($prod = 1; $prod <= 10; $prod++){
              $product = new Products();
              $product->setName($faker->text(15));
              $product->setDescription($faker->text());
              $product->setSlug($this->slugger->slug($product->getName())->lower());
              $product->setPrice($faker->numberBetween(900, 150000));
              $product->setQuantity($faker->numberBetween(0, 10));

            $manager->persist($product);
            }
            $manager->flush();
    }
}
