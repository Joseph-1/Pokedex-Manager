<?php

namespace App\Controller\Api;

use App\Entity\Type;
use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class TypeController extends AbstractController
{
    #[Route('/api/types', name: 'api_type_index', methods: ['GET'])]
    public function index(TypeRepository $repo): JsonResponse
    {
        $types = $repo->findAll();

        $data = array_map(function (Type $type) {
            return [
                'id' => $type->getId(),
                'name' => $type->getName(),
                'style' => $type->getStyle(),
            ];
        }, $types);

        return $this->json($data);
    }
}
