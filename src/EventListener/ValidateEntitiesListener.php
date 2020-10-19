<?php
/**
 * @Author <Akartis>
 *
 * Do it with love
 */

namespace App\EventListener;


use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ValidateEntitiesListener
{

	private ValidatorInterface $validator;

	public function __construct(ValidatorInterface $validator)
	{
		$this->validator = $validator;
	}

	public function prePersist(LifecycleEventArgs $args)
	{
		$obj = $args->getObject();
		/** @var ConstraintViolationList $errors */
		$errors = $this->validator->validate($obj);
		if ($errors->count() > 0) {
			throw new BadRequestHttpException("Une erreur au niveau des champs");
		}
	}

}
