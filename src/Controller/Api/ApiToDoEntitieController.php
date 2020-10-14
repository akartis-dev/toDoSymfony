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
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/member/api/todo/entities")
 * Class ApiToDoEntitieController
 * @package App\Controller\Api
 */
class ApiToDoEntitieController extends AbstractController
{
	use GroupsSerializerTrait;

	private DataSerializerHelper $serializer;

	public function __construct(DataSerializerHelper $serializer)
	{
		$this->serializer = $serializer;
	}


	/**
	 * @Route("/{uuid}", name="api.item.todo.entitie", methods={"GET"})
	 * @param ToDoEntities|null $entities
	 * @return Response
	 */
	public function itemGetToDoEntitie(?ToDoEntities $entities): Response
	{
		if(!$entities){
			throw new BadRequestHttpException("entite introuvable");
		}
		return $this->serializer->serializeData($entities, $this->TO_DO_ENTITIE_GET);
	}

}
