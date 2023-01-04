<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Ustensile;
use App\Entity\Ingredient;
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

        $user->setEmail("user@mukitchen.com")
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

        $manager->flush();
    }
}
