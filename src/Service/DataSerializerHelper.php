<?php
/**
 * @Author <Akartis>
 *
 * Do it with love
 */

namespace App\Service;


use App\Entity\Todo\ToDoCategorie;
use App\Entity\Todo\ToDoList;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\SerializerInterface;

class DataSerializerHelper
{

	private SerializerInterface $serializer;
	private EntityManagerInterface $em;

	public function __construct(SerializerInterface $serializer, EntityManagerInterface $em)
	{
		$this->serializer = $serializer;
		$this->em = $em;
	}

	/**
	 * Serialize data and return a response for api
	 * @param $res
	 * @param string $group
	 * @return Response
	 */
	public function serializeData($res, string $group): Response
	{
		$data = $this->serializer->serialize($res, 'json', ['groups' => $group]);
		$response = new Response($data);
		$response->headers->set('Content-Type', 'application/json');
		return $response;
	}

	public function deserializeData($data, string $class, string $group)
	{
		return $this->serializer->deserialize($data, $class, 'json', ['groups' => $group]);
	}

	public function deserializeToDoList($data)
	{
		$categorieUuid = json_decode($data, true, 512, JSON_THROW_ON_ERROR)['categorie'];
		$categorie = $this->em->getRepository(ToDoCategorie::class)->findOneBy(['uuid' => $categorieUuid]);

		if (!$categorie) {
			throw new NotFoundHttpException("Categorie introuvable");
		}

		/** @var ToDoList $todo */
		$todo = $this->serializer->deserialize($data, ToDoList::class, 'json', ['groups' => 'post']);
		$todo->setCategorie($categorie);
		return $todo;
	}

}
