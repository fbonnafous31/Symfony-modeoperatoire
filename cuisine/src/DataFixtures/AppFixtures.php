<?php

namespace App\DataFixtures;

use App\Entity\CategoriesPrix;
use App\Entity\User;
use App\Entity\Ustensile;
use App\Entity\Ingredient;
use App\Entity\NiveauDifficulte;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    protected $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $admin = new User;
        $hash = $this->hasher->hashPassword($admin, "password");

        $admin->setEmail("admin@mykitchen.com")
            ->setPassword($hash)
            ->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        $user = new User;
        $hash = $this->hasher->hashPassword($user, "password");

        $user->setEmail("user@mykitchen.com")
            ->setPassword($hash);
        $manager->persist($user);

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

        $categorie1 = new CategoriesPrix;
        $categorie1->setCategorie(1)
            ->setDescription('Bon marché');
        $manager->persist($categorie1);

        $categorie2 = new CategoriesPrix;
        $categorie2->setCategorie(2)
            ->setDescription('Moyen');
        $manager->persist($categorie2);

        $categorie3 = new CategoriesPrix;
        $categorie3->setCategorie(3)
            ->setDescription('Assez cher');
        $manager->persist($categorie3);

        $categorie4 = new CategoriesPrix;
        $categorie4->setCategorie(4)
            ->setDescription('Cher');
        $manager->persist($categorie4);


        $niveau1 = new NiveauDifficulte;
        $niveau1->setNiveau(1)
            ->setDescription('Facile');
        $manager->persist($niveau1);

        $niveau2 = new NiveauDifficulte;
        $niveau2->setNiveau(2)
            ->setDescription('Moyen');
        $manager->persist($niveau2);

        $niveau3 = new NiveauDifficulte;
        $niveau3->setNiveau(3)
            ->setDescription('Difficile');
        $manager->persist($niveau3);

        $manager->flush();
    }
}
