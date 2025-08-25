<?php

namespace App\Controller\Api;

use App\Entity\Type;
use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

final class TypeController extends AbstractController
{
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
