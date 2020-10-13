<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

	/**
	 * @var UserPasswordEncoderInterface
	 */
	private UserPasswordEncoderInterface $encoder;

	public function __construct(UserPasswordEncoderInterface $encoder)
	{
		$this->encoder = $encoder;
	}

	public function load(ObjectManager $manager)
	{
		for ($i = 1; $i <= 5; $i++) {
			$user = (new User())->setUsername("user-{$i}");
			$password = $this->encoder->encodePassword($user, '12345');
			$user->setPassword($password);

			$manager->persist($user);
		}
		$manager->flush();
	}
}
