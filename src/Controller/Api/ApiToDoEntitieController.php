<?php
/**
 * @Author <Akartis>
 *
 * Do it with love
 */

namespace App\Controller\Api;


use App\Entity\Todo\ToDoEntities;
use App\Service\DataSerializerHelper;
use App\Traits\GroupsSerializerTrait;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/member/api/todo/entities")
 * Class ApiToDoEntitieController
 * @package App\Controller\Api
 */
class ApiToDoEntitieController extends AbstractController
{
	use GroupsSerializerTrait;

	private DataSerializerHelper $serializer;
	private EntityManagerInterface $em;
	private Security $security;

	public function __construct(DataSerializerHelper $serializer, EntityManagerInterface $em, Security $security)
	{
		$this->serializer = $serializer;
		$this->em = $em;
		$this->security = $security;
	}


	/**
	 * @Route("/", name="api.post.todo.entitie", methods={"POST"})
	 * @param Request $request
	 * @return Response
	 */
	public function collPostToDoEntitie(Request $request): Response
	{
		/** @var ToDoEntities $entitie */
		$entitie = $this->serializer->deserializeData($request->getContent(), ToDoEntities::class, $this->TO_DO_ENTITIE_POST);
		$entitie->setUser($this->security->getUser());
		$this->em->persist($entitie);
		$this->em->flush();
		return $this->serializer->serializeData($entitie, $this->TO_DO_ENTITIE_GET);
	}

	/**
	 * @Route("/{uuid}", name="api.item.todo.entitie", methods={"GET"})
	 * @param ToDoEntities|null $entities
	 * @return Response
	 */
	public function itemGetToDoEntitie(?ToDoEntities $entities): Response
	{
		if (!$entities) {
			throw new BadRequestHttpException("entite introuvable");
		}
		return $this->serializer->serializeData($entities, $this->TO_DO_ENTITIE_GET);
	}
}
