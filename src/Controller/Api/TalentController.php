<?php

namespace App\Controller\Api;

use App\Entity\Talent;
use App\Repository\TalentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class TalentController extends AbstractController
{
    #[Route('/api/talents', name: 'api_talent_index', methods: ['GET'])]
    public function index(TalentRepository $repo): JsonResponse
    {
        $talents = $repo->findAll();

        $data = array_map(function (Talent $talent) {
            return [
                'id' => $talent->getId(),
                'name' => $talent->getName(),
                'description' => $talent->getDescription(),
            ];
        }, $talents);

        return $this->json($data);
    }
}
