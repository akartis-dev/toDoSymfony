<?php

namespace App\DataFixtures;

use App\Entity\Todo\ToDoCategorie;
use App\Entity\Todo\ToDoList;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class TodoFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
		$faker = Factory::create('fr_FR');
		$categorie = [];
		for ($i = 0; $i < 5; $i++){
			$toDoCategorie = (new ToDoCategorie())
				->setTitle($faker->sentence(10))
				->setLimitAt($faker->dateTimeBetween('-7 days'));
			$categorie[] = $toDoCategorie;
			$manager->persist($toDoCategorie);
		}

		for($i = 0; $i < 30; $i++){
			$toDoList = (new ToDoList())
				->setContent($faker->sentence(15))
				->setCategorie($faker->randomElement($categorie));
			$manager->persist($toDoList);
		}

        $manager->flush();
    }
}
