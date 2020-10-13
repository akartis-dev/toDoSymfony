<?php
/**
 * @Author <Akartis>
 *
 * Do it with love
 */

namespace App\Service;


use App\Entity\Todo\ToDoCategorie;
use App\Entity\Todo\ToDoList;
use App\Traits\GroupsSerializerTrait;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class DataSerializerHelper
{

	use GroupsSerializerTrait;

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

	/**
	 * Deserialize data to convert into Entity
	 * @param $data
	 * @param string $class
	 * @param string $group
	 * @return array|object
	 */
	public function deserializeData($data, string $class, string $group)
	{
		return $this->serializer->deserialize($data, $class, 'json', ['groups' => $group]);
	}

	/**
	 * Deserialize a ToDoList json from Request into Entity and get categorie
	 * @param $data
	 * @return ToDoList
	 * @throws \JsonException
	 */
	public function deserializeToDoList($data): ToDoList
	{
		$categorieUuid = json_decode($data, true, 512, JSON_THROW_ON_ERROR)['categorie'];
		$categorie = $this->em->getRepository(ToDoCategorie::class)->findOneBy(['uuid' => $categorieUuid]);

		if (!$categorie) {
			throw new NotFoundHttpException("Categorie introuvable");
		}

		/** @var ToDoList $todo */
		$todo = $this->serializer->deserialize($data, ToDoList::class, 'json', ['groups' => $this->TO_DO_LIST_POST]);
		$todo->setCategorie($categorie);
		return $todo;
	}

	/**
	 * Deserialize into an existing object and flush modification
	 * @param $list mixed passed from url
	 * @param $data mixed content passed from request to update $list
	 * @param string $group group to use in deserializer
	 * @return mixed
	 */
	public function deserializePut($list, $data, string $group)
	{
		$this->serializer->deserialize($data, get_class($list), 'json', ['groups' => $group, AbstractNormalizer::OBJECT_TO_POPULATE => $list]);
		$this->em->flush();
		return $list;
	}

}
