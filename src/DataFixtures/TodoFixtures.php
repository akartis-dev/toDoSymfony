<?php

namespace App\DataFixtures;

use App\Entity\Todo\ToDoCategorie;
use App\Entity\Todo\ToDoEntities;
use App\Entity\Todo\ToDoList;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class TodoFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
		$faker = Factory::create('fr_FR');
		$user = $manager->getRepository(User::class)->findAll();
		$todoEntitie = [];
	    for ($i = 0; $i < 5; $i++){
		    $entitie = (new ToDoEntities())
			    ->setTitle($faker->sentence(10))
			    ->setUser($faker->randomElement($user))
			    ->setCreatedAt($faker->dateTimeBetween("-1 year"));
		    $todoEntitie[] = $entitie;
		    $manager->persist($entitie);
	    }

		$categorie = [];
		for ($i = 0; $i < 10; $i++){
			$toDoCategorie = (new ToDoCategorie())
				->setTitle($faker->sentence(10))
				->setToDoEntities($faker->randomElement($todoEntitie))
				->setLimitAt($faker->dateTimeBetween('-7 days'));
			$categorie[] = $toDoCategorie;
			$manager->persist($toDoCategorie);
		}

		for($i = 0; $i < 30; $i++){
			$toDoList = (new ToDoList())
				->setContent($faker->sentence(15))
				->setIsDone($faker->randomElement([true, false]))
				->setCategorie($faker->randomElement($categorie));
			$manager->persist($toDoList);
		}

        $manager->flush();
    }
}
