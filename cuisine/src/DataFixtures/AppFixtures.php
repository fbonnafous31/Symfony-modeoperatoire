<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use App\Entity\Ustensile;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $file = fopen(__DIR__ . '/../../public/csv/Ingredients.csv', 'r');
        while (!feof($file)) {
            $ingredient = new Ingredient;
            $ingredient->setNom(implode(fgetcsv($file, 1024)));

            $manager->persist($ingredient);
        }
        fclose($file);

        $manager->flush();

        $file = fopen(__DIR__ . '/../../public/csv/Ustensiles.csv', 'r');
        while (!feof($file)) {
            $ustensile = new Ustensile;
            $ustensile->setNom(implode(fgetcsv($file, 1024)));

            $manager->persist($ustensile);
        }
        fclose($file);

        $manager->flush();
    }
}
